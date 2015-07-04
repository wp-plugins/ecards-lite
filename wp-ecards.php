<?php
/*
Plugin Name: eCards
Plugin URI: https://getbutterfly.com/wordpress-plugins/wordpress-ecards-plugin/
Description: eCards is a plugin used to send electronic cards to friends. It can be implemented in a page, a post or the sidebar. eCards makes it quick and easy for you to send an eCard in 3 easy steps. Just choose your favorite eCard, add your personal message, and send it to any email address. Use preset images, upload your own or select from your Dropbox folder.
Author: Ciprian Popescu
Author URI: https://getbutterfly.com/
Version: 3.0.2

eCards
Copyright (C) 2011, 2012, 2013, 2014, 2015 Ciprian Popescu (getbutterfly@gmail.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

//
define('ECARDS_PLUGIN_URL', WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__)));
define('ECARDS_PLUGIN_PATH', WP_PLUGIN_DIR . '/' . dirname(plugin_basename(__FILE__)));
define('ECARDS_VERSION', '3.0.2');
//

// plugin localization
$plugin_dir = basename(dirname(__FILE__)); 
load_plugin_textdomain('ecards', false, $plugin_dir . '/languages');

function eCardsInstall() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'ecards_stats';
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . " (
			`date` date NOT NULL,
			`sent` mediumint(9) NOT NULL,
            UNIQUE KEY `date` (`date`)
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

    // Default options
	add_option('ecard_label_name_own', 'Your name');
	add_option('ecard_label_email_own', 'Your email address');
	add_option('ecard_label_email_friend', 'Your friend email address');
	add_option('ecard_label_message', 'eCard message');
    add_option('ecard_submit', 'Send eCard');

    add_option('ecard_label', 0);
    add_option('ecard_custom_style', 'Vintage');
    add_option('ecard_counter', 0);
    add_option('ecard_behaviour', 1);
    add_option('ecard_link_anchor', 'Click to see your eCard!');

    // email settings
    add_option('ecard_title', 'eCard!');
    add_option('ecard_body_additional', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
    add_option('ecard_body_toggle', 1);

    // members only settings
    add_option('ecard_restrictions', 0);
    add_option('ecard_restrictions_message', 'This section is restricted to members only.');

    // send all eCards to a universal email address
    add_option('ecard_send_behaviour', 1);
    add_option('ecard_hardcoded_email', '');

    //
    add_option('ecard_image_size', 'thumbnail');
    add_option('ecard_shortcode_fix', 'off');

	//
	add_option('ecard_use_akismet', 'false');

	//
	add_role('ecards_sender', __('eCards Sender', 'ecards'), array('read' =>  false, 'edit_posts' => false, 'delete_posts' => false));

    // clean up, please // 2.4
    delete_option('ecard_cta');
    delete_option('ecard_body_intro');

    delete_option('ecard_mail_from_name');
    delete_option('ecard_mail_from_email');

    delete_option('ecard_body_footer');
    delete_option('ecard_user_upload');
    delete_option('ecard_stats_days');

    delete_option('ecard_thumbnail_width');
    delete_option('ecard_thumbnail_height');
    delete_option('ecard_remove_filters');

    delete_option('ecard_email_validation');

	// reCAPTCHA settings // 2.9
    delete_option('ecard_captcha_display');
    delete_option('ecard_rc_public');
    delete_option('ecard_rc_private');
    delete_option('ecard_rc_theme');
    delete_option('ecard_rc_type');

	//
	remove_role('ecards_recipient');
}

register_activation_hook(__FILE__, 'eCardsInstall');
//

// apply content shortcode fix
if(get_option('ecard_shortcode_fix') === 'on')
    add_filter('the_content', 'do_shortcode');

include(ECARDS_PLUGIN_PATH . '/includes/functions.php');
include(ECARDS_PLUGIN_PATH . '/includes/page-options.php');



function display_ecardMe() {
	$ecard_submit = get_option('ecard_submit');

	$ecard_behaviour = get_option('ecard_behaviour');
	$ecard_link_anchor = get_option('ecard_link_anchor');

	// email settings
	$ecard_title = get_option('ecard_title');
	$ecard_body_additional = wpautop(get_option('ecard_body_additional'));
	$ecard_body_toggle = get_option('ecard_body_toggle');

    // send eCard
    // routine
    // since eCards 2.2
	if(isset($_POST['ecard_send'])) {
        $subject = sanitize_text_field($ecard_title);

		if(get_option('ecard_send_behaviour') === '1')
			$ecard_to = sanitize_email($_POST['ecard_to']);
		if(get_option('ecard_send_behaviour') === '0')
			$ecard_to = sanitize_email(get_option('ecard_hardcoded_email'));

		// check if <Mail From> fields are filled in
		$ecard_from = sanitize_text_field($_POST['ecard_from']);
		$ecard_email_from = sanitize_email($_POST['ecard_email_from']);

		$ecard_mail_message = sanitize_text_field($_POST['ecard_message']);

		$ecard_referer = esc_url($_POST['ecard_referer']);

		// gallery (attachments) mode
		if(isset($_POST['ecard_pick_me'])) {
			$ecard_pick_me = sanitize_text_field($_POST['ecard_pick_me']);
			$large = wp_get_attachment_image_src($ecard_pick_me, 'large');
			$ecard_pick_me = '<img src="' . $large[0] . '" alt="">';
		}
		//

		/*
         * MANAGE BEHAVIOURS // OPTIMIZED FROM 2.4.3
        /*
		0. Hide eCard inside email message (show link to source)
		1. Show eCard inside email message (show link to source)
		5. Show eCard inside email message (hide link to source)
		2. Hide both eCard and link to source
		3. Show custom link
		*/

        // begin message
		$ecard_message = '';
		$ecard_body_footer = '';

		$ecard_message .= '<p>' . $ecard_mail_message . '</p>';

        if(get_option('ecard_behaviour') === '0') {
			$ecard_message 	.= '<p>' . wp_get_attachment_link(sanitize_text_field($_POST['ecard_pick_me']), 'thumbnail', true, false, $ecard_link_anchor) . '</p>';
			$ecard_message 	.= '<p><small><a href="' . $ecard_referer . '">' . $ecard_referer . '</a></small></p>';
		}
		if(get_option('ecard_behaviour') === '1') {
			if(!empty($_POST['selected-file'])) {
				$ecard_message 	.= '<p><b><a href="' . esc_url($_POST['selected-file']) . '">' . esc_url($_POST['selected-file']) . '</a></b></p>';
				$ecard_body_footer .= '<p><small><a href="' . $ecard_referer . '">' . $ecard_referer . '</a></small></p>';
			}
			else {
                if(!empty($ecard_pick_me)) { // if there's no selected eCard (only user uploaded one)
				    $ecard_message 	.= '<p>' . $ecard_pick_me . '</p>';
                    $ecard_body_footer .= '<p>' . wp_get_attachment_link(sanitize_text_field($_POST['ecard_pick_me']), 'thumbnail', true, false, $ecard_link_anchor) . '</p>';
                }
			}
		}
		if(get_option('ecard_behaviour') === '2') {
			$ecard_message 	.= '';
		}
		if(get_option('ecard_behaviour') === '3') {
			$ecard_message 	.= '';
		}
		if(get_option('ecard_behaviour') === '5') {
			if(!empty($_POST['selected-file']))
				$ecard_message 	.= '<p><b><a href="' . esc_url($_POST['selected-file']) . '">' . esc_url($_POST['selected-file']) . '</a></b></p>';
			else
				$ecard_message 	.= '<p>' . $ecard_pick_me . '</p>';
		}

		$ecard_message .= '<p>' . $ecard_body_additional . '</p>';
		$ecard_message .= '<p>' . $ecard_body_footer . '</p>';
		$ecard_message .= '<p><small><strong>' . $ecard_from . '</strong> (' . $ecard_email_from . ')</small></p>';

		$attachments = '';

        $headers = '';
		$headers[] = "Content-Type: text/html;";
		$headers[] = "From: $ecard_from <$ecard_email_from>;";

		// Akismet
		$content['comment_author'] = $ecard_from;
		$content['comment_author_email'] = $ecard_email_from;
		$content['comment_author_url'] = home_url();
		$content['comment_content'] = $ecard_message;

		if(ecard_checkSpam($content)) {
			echo '<p><strong>' . __('Akismet prevented sending of this eCard and marked it as spam!', 'ecards') . '</strong></p>';
		}
		else {
			wp_mail($ecard_to, $subject, $ecard_message, $headers, $attachments);

			echo '<p class="ecard-confirmation"><strong>' . __('eCard sent successfully!', 'ecards') . '</strong></p>';
			ecards_save();
		}
	}

	$output = '';

	$output .= '<div class="ecard-container">';
		$output .= '<form action="#" method="post" enctype="multipart/form-data">';

        // get all post attachments
        $args = array(
            'post_type'         => 'attachment',
            'numberposts'       => -1,
            'post_status'       => null,
            'post_parent'       => get_the_ID(),
            'post_mime_type'    => 'image',
            'orderby'           => 'menu_order',
            'order'             => 'ASC',
            'exclude'           => get_post_thumbnail_id(get_the_ID()),
        );
        $attachments = get_posts($args);

        $ecard_image_size = get_option('ecard_image_size');

        if($attachments) {
            if(count($attachments) == 1)
                $hide_radio = 'style="display: none;"';
            else
                $hide_radio = '';

            $output .= '<div role="radiogroup">';
                foreach($attachments as $a) {
                    $alt = get_post_meta($a->ID, '_wp_attachment_image_alt', true);
                    if($alt != 'noselect') {
                        $output .= '<div class="ecard">';
                            $large = wp_get_attachment_image_src($a->ID, 'large');
                            $thumb = wp_get_attachment_image($a->ID, $ecard_image_size);
							if(get_option('ecard_label') == 0) {
								$output .= '<a href="' . $large[0] . '" class="ecards">' . $thumb . '</a><br><input type="radio" name="ecard_pick_me" id="ecard' . $a->ID . '" value="' . $a->ID . '" ' . $hide_radio . ' checked><label for="ecard' . $a->ID . '"></label>';
							}
							if(get_option('ecard_label') == 1) {
								$output .= '<label for="ecard' . $a->ID . '">' . $thumb . '<br><input type="radio" name="ecard_pick_me" id="ecard' . $a->ID . '" value="' . $a->ID . '" ' . $hide_radio . ' checked></label>';
							}
                        $output .= '</div>';
                    }
                }
                $output .= '<div style="clear:both;"></div>';
            $output .= '</div>';
        }
        // end

	$output .= '<p><input type="text" name="ecard_from" size="30" required> ' . get_option('ecard_label_name_own') . '</p>';
	$output .= '<p><input type="email" name="ecard_email_from" size="30" required> ' . get_option('ecard_label_email_own') . '</p>';

	if(get_option('ecard_send_behaviour') === '1')
        $output .= '<p><input type="email" name="ecard_to" size="30" required> ' . get_option('ecard_label_email_friend') . '</p>';

    if($ecard_body_toggle === '1')
        $output .= '<p>' . get_option('ecard_label_message') . '<br><textarea name="ecard_message" rows="6" cols="60"></textarea></p>';
    if($ecard_body_toggle === '0')
        $output .= '<input type="hidden" name="ecard_message">';

			$output .= '<p>
				<input type="hidden" name="ecard_referer" value="' . get_permalink() . '">
				<input type="submit" name="ecard_send" value="' . $ecard_submit . '" class="m-btn blue">
			</p>';
		$output .= '</form>';
	$output .= '</div>';

	if(get_option('ecard_restrictions') === '0')
		return $output;
	if(get_option('ecard_restrictions') === '1' && is_user_logged_in())
		return $output;
	if(get_option('ecard_restrictions') === '1' && !is_user_logged_in())
		$output = get_option('ecard_restrictions_message');

	return $output;
}

function display_ecardCounter() {
	$ecard_counter = get_option('ecard_counter');

	return $ecard_counter;
}

add_shortcode('ecard', 'display_ecardMe');
add_shortcode('ecard_counter', 'display_ecardCounter');

add_action('wp_enqueue_scripts', 'ecard_enqueue_scripts');
function ecard_enqueue_scripts() {
	if(get_option('ecard_custom_style') === 'Vintage')
		wp_enqueue_style('ecards', plugins_url('css/vintage.css', __FILE__));
	if(get_option('ecard_custom_style') === 'MetroL')
		wp_enqueue_style('ecards', plugins_url('css/metro-light.css', __FILE__));
	if(get_option('ecard_custom_style') === 'MetroD')
		wp_enqueue_style('ecards', plugins_url('css/metro-dark.css', __FILE__));

	if(get_option('ecard_custom_style') === 'Theme')
		wp_enqueue_style('ecards', plugins_url('css/extended.css', __FILE__));
}

// Displays options menu
function ecard_add_option_page() {
	add_options_page('eCards', 'eCards', 'manage_options', 'ecards', 'ecard_options_page');
}

add_action('admin_menu', 'ecard_add_option_page');

// custom settings link inside Plugins section
function ecards_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page=ecards">Settings</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'ecards_settings_link');
?>
