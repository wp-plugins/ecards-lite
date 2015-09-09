<?php
function ecard_options_page() {
	global $ecard_version;

	$ecard_counter = get_option('ecard_counter');

	if(isset($_POST['info_settings_update'])) {
		update_option('ecard_label', sanitize_text_field($_POST['ecard_label']));
		update_option('ecard_custom_style', sanitize_text_field($_POST['ecard_custom_style']));

        update_option('ecard_image_size', sanitize_text_field($_POST['ecard_image_size']));
        update_option('ecard_shortcode_fix', sanitize_text_field($_POST['ecard_shortcode_fix']));

		update_option('ecard_use_akismet', sanitize_text_field($_POST['ecard_use_akismet']));

        echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options updated successfully!', 'ecards') . '</p></div>';
	}
	if(isset($_POST['info_payment_update'])) {
		update_option('ecard_restrictions', sanitize_text_field($_POST['ecard_restrictions']));
		update_option('ecard_restrictions_message', sanitize_text_field($_POST['ecard_restrictions_message']));

        echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options updated successfully!', 'ecards') . '</p></div>';
	}
	if(isset($_POST['info_email_update'])) {
		update_option('ecard_noreply', sanitize_email($_POST['ecard_noreply']));
		update_option('ecard_behaviour', sanitize_text_field($_POST['ecard_behaviour']));
		update_option('ecard_link_anchor', sanitize_text_field($_POST['ecard_link_anchor']));

		update_option('ecard_title', $_POST['ecard_title']);
		update_option('ecard_body_additional', esc_html(stripslashes_deep($_POST['ecard_body_additional'])));
		update_option('ecard_body_footer', sanitize_text_field($_POST['ecard_body_footer']));

		update_option('ecard_body_toggle', sanitize_text_field($_POST['ecard_body_toggle']));

		update_option('ecard_send_behaviour', sanitize_text_field($_POST['ecard_send_behaviour']));
		update_option('ecard_hardcoded_email', sanitize_email($_POST['ecard_hardcoded_email']));

        echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options updated successfully!', 'ecards') . '</p></div>';
	}
	if(isset($_POST['info_labels_update'])) {
	    update_option('ecard_label_name_own', sanitize_text_field($_POST['ecard_label_name_own']));
	    update_option('ecard_label_email_own', sanitize_text_field($_POST['ecard_label_email_own']));
	    update_option('ecard_label_email_friend', sanitize_text_field($_POST['ecard_label_email_friend']));
	    update_option('ecard_label_message', sanitize_text_field($_POST['ecard_label_message']));
		update_option('ecard_submit', sanitize_text_field($_POST['ecard_submit']));

        echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options updated successfully!', 'ecards') . '</p></div>';
	}
	if(isset($_POST['info_debug_update'])) {
		$headers = '';
		$headers[] = "Content-Type: text/html;";
        if(!empty($_POST['ecard_test_email']) && wp_mail($_POST['ecard_test_email'], 'eCards test email', 'Testing eCards plugin...', $headers)) {
            echo '<div id="message" class="updated notice is-dismissible"><p>Mail sent successfully. Check your inbox.</p></div>';
        } else {
            echo '<div id="message" class="updated notice notice-error is-dismissible"><p>Mail not sent. Check your server configuration.</p></div>';
        }

		echo '<div id="message" class="updated notice is-dismissible"><p>Options updated successfully!</p></div>';
	}
	?>
	<style>
	.ecards-lite-icon { background-color: #F39C12; color: #ffffff; padding: 2px 4px; font-size: 11px; text-transform: uppercase; border-radius: 3px; font-weight: 400; border-left: 4px solid rgba(0, 0, 0, 0.25); }
	.ecards-pro-icon { background-color: #9B59B6; color: #ffffff; padding: 2px 4px; font-size: 11px; text-transform: uppercase; border-radius: 3px; font-weight: 400; border-left: 4px solid rgba(0, 0, 0, 0.25); }
	.ecards-pro-label { opacity: 0.75; cursor: not-allowed !important; }
	</style>
	<div class="wrap">
		<h2>eCards</h2>

		<?php
		$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'ecards_dashboard';
		if(isset($_GET['tab']))
			$active_tab = $_GET['tab'];
		?>
		<h2 class="nav-tab-wrapper">
			<a href="?page=ecards&amp;tab=ecards_dashboard" class="nav-tab <?php echo $active_tab === 'ecards_dashboard' ? 'nav-tab-active' : ''; ?>"><?php _e('Home', 'ecards'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_settings" class="nav-tab <?php echo $active_tab === 'ecards_settings' ? 'nav-tab-active' : ''; ?>"><?php _e('Settings', 'ecards'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_email" class="nav-tab <?php echo $active_tab === 'ecards_email' ? 'nav-tab-active' : ''; ?>"><?php _e('Email Options', 'ecards'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_payment" class="nav-tab <?php echo $active_tab === 'ecards_payment' ? 'nav-tab-active' : ''; ?>"><?php _e('Restrictions &amp; Payment', 'ecards'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_labels" class="nav-tab <?php echo $active_tab === 'ecards_labels' ? 'nav-tab-active' : ''; ?>"><?php _e('Labels', 'ecards'); ?></a>
			<a href="?page=ecards&amp;tab=ecards_diagnostics" class="nav-tab <?php echo $active_tab === 'ecards_diagnostics' ? 'nav-tab-active' : ''; ?>"><?php _e('Diagnostics', 'ecards'); ?></a>
		</h2>
		<div id="poststuff">
            <div class="postbox">
                <h3><div class="dashicons dashicons-welcome-view-site"></div> <strong>eCards Updates</strong></h3>
                <div class="inside">
                    <p>The eCards theme features enhanced integration, dedicated homepage, in-place sliders and more! You need eCards plugin <b>3.0</b> or higher in order to use the official theme. Make sure you select the official theme style from <b>eCards Settings</b> &ndash; <b>eCards style</b>.</p>
                    <a href="//codecanyon.net/item/wordpress-ecards/1051966" rel="external" class="button button-primary button-hero">Get <span class="ecards-pro-icon">PRO</span> version!</a>
                    <a href="//getbutterfly.com/marketplace/ecards-theme-wordpress/" rel="external" class="button button-secondary button-hero">Get eCards theme!</a>
                </div>
            </div>
        </div>
		<?php if($active_tab === 'ecards_dashboard') { ?>
			<div id="poststuff" class="ui-sortable meta-box-sortables">
				<div class="postbox">
					<h3>About WordPress eCards <small>(<a href="//getbutterfly.com/wordpress-plugins/wordpress-ecards-plugin/" rel="external">official web site</a>)</small></h3>
					<div class="inside">
						<p>
                            You are using <b>eCards</b> version <b><?php echo ECARDS_VERSION; ?></b> <span class="ecards-lite-icon">LITE</span> with <b><?php bloginfo('charset'); ?></b> charset.<br>
                            <small>You are using PHP version <?php echo PHP_VERSION; ?> and MySQL server version <?php echo mysqli_get_client_info(); ?>.</small><br>
							<b><?php echo $ecard_counter; ?></b> total eCards sent!
						</p>

						<h2><b>Summary and Usage Examples</b> (shortcodes and template tags):</h2>
                        <p>eCards uses one shortcode: <code>[ecard]</code> for images (JPG, PNG, GIF).</p>
                        <p>Adding eCards to a post or a page is accomplished by uploading one or more images for <code>[ecard]</code> shortcode. Images should be uploaded directly to the post or page, not from the <b>Media Library</b>. Inserting the images is not necessary, as the plugin creates the eCard automatically.</p>

                        <blockquote>
                            <p>
                                <small>1.</small> Add the <code>[ecard]</code> shortcode to a post or a page or call the function from a template file:<br>
                                <code>&lt;?php if(function_exists('display_ecardMe')) echo display_ecardMe(); ?&gt;</code>
                            </p>
                            <p>
                                <small>2.</small> Use the <code>[ecard_counter]</code> shortcode to display the number of eCards sent or call the function from a template file (example: [ecard_counter] eCards sent so far!):<br>
                                <code>&lt;?php if(function_exists('display_ecardCounter')) echo display_ecardCounter(); ?&gt;</code>
                            </p>
                            <p><small>3.</small> Use the <code>[paypal amount=8][ecard][/paypal]</code> shortcode to hide the eCard form and require payment. Only guests and non-members see the payment button. Members always see the hidden content.</p>

                            <p><small>4.</small> Use <code>noselect</code> as ALT text for attached images you do not want included as eCards.</p>
                        </blockquote>

                        <h2><b>Styling Examples</b> (CSS classes):</h2>
						<p>Use <code>.ecard-confirmation</code> class to style the confirmation message, use <code>.ecard-error</code> class to style the error message. The submit button has two classes: <code>.m-btn</code> and <code>.blue</code>. They are both used for the three themes, <b>Vintage</b>, <b>Metro Light</b> and <b>Metro Dark</b>.</p>

						<p>Use <code>.ecards</code> class as a selector for lightbox plugins. Based on your plugin configuration, you can also use <code>.ecard a</code> as a selector.</p>

                        <h2><b>Email Details and Spam</b> (workarounds and solutions):</h2>
                        <p>Sometimes emails end up in your spam (or junk) folder. Sometimes they don't arrive at all. While the latter may indicate a server issue, the former may easily be fixed by setting up an email address (ecards@yourdomain.com or noreply@yourdomain.com) and use a third-party plugin to override email options (<b>From Name</b> and <b>From Email</b>). We recommend <a href="https://wordpress.org/plugins/wp-mailfrom-ii/">WP Mail From II</a>. If you are using any plugin that allows you to configure SMTP within WordPress, please deactivate it or reconsider its usefulness. Read more <a href="http://premium.wpmudev.org/blog/wordpress-email-settings/" rel="external">here</a> or <a href="https://support.google.com/mail/answer/180707?hl=en" rel="external">here</a>.</p>
					</div>
				</div>
			</div>
		<?php } if($active_tab === 'ecards_settings') { ?>
			<form method="post" action="">
    			<h3 class="title"><?php _e('eCards Settings', 'ecards'); ?></h3>
                <p><b>Note:</b> To avoid your email adress being marked as spam, it is highly recommended that your "from" domain match your website. Some hosts may require that your "from" address be a legitimate address. Use a plugin to set custom <b>From Name</b> and <b>From Email</b> headers. We recommend <a href="https://wordpress.org/plugins/wp-mailfrom-ii/">WP Mail From II</a>.</p>
    		    <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_label">eCard behaviour</label></th>
    		                <td>
								<select name="ecard_label" id="ecard_label" class="regular-text">
									<option value="0"<?php if(get_option('ecard_label') == 0) echo ' selected'; ?>>Use source (large image) for eCard thumbnail</option>
									<option value="1"<?php if(get_option('ecard_label') == 1) echo ' selected'; ?>>Use label behaviour for eCard thumbnail</option>
								</select>
                                <br><small>Choose what happens when users click on eCards.</small>
    		                </td>
    		            </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_custom_style">eCard style</label></th>
    		                <td>
								<select name="ecard_custom_style" id="ecard_custom_style" class="regular-text">
									<option value="Vintage"<?php if(get_option('ecard_custom_style') === 'Vintage') echo ' selected'; ?>>Use Vintage style (recommended)</option>
									<option value="Theme"<?php if(get_option('ecard_custom_style') === 'Theme') echo ' selected'; ?>>Use official eCards theme style</option>
									<option value="None"<?php if(get_option('ecard_custom_style') === 'None') echo ' selected'; ?>>Use no custom style (inherit from theme)</option>
								</select> More styles are available in the <span class="ecards-pro-icon">PRO</span> version
                                <br><small>Use no custom style if you have problems displaying the eCard form.</small>
    		                </td>
    		            </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_use_akismet">Akismet settings</label></th>
    		                <td>
								<select name="ecard_use_akismet" id="ecard_use_akismet" class="regular-text">
									<option value="true"<?php if(get_option('ecard_use_akismet') === 'true') echo ' selected'; ?>>Use Akismet (recommended)</option>
									<option value="false"<?php if(get_option('ecard_use_akismet') === 'false') echo ' selected'; ?>>Do not use Akismet</option>
								</select>
    							<?php
    							if(function_exists('akismet_init')) {
    								$wpcom_api_key = get_option('wordpress_api_key');
    
    								if(!empty($wpcom_api_key)) {
    									echo '<p><small>Your Akismet plugin is installed and working properly. Your API key is <code>' . $wpcom_api_key . '</code>.</small></p>';
    								}
    								else {
    									echo '<p><small>Your Akismet plugin is installed but no API key is present. Please fix it.</small></p>';
    								}
    							}
    							else {
    								echo '<p><small>You need Akismet in order to send eCards. Please install/activate it.</small></p>';
    							}
    							?>
    		                </td>
    		            </tr>
    		            <tr class="ecards-pro-label">
    		                <th scope="row"><label for="ecard_user_enable">User upload settings</label> <span class="ecards-pro-icon">PRO</span></th>
    		                <td>
                                <p>
                                    <input type="checkbox" name="ecard_user_enable" value="0" disabled> <label>Enable user upload</label><br>
                                    <input type="checkbox" name="ecard_dropbox_enable" value="0" disabled> <label>Enable Dropbox upload</label>
                                </p>
                                <p>
                                    <input name="ecard_dropbox_private" id="ecard_dropbox_private" type="text" class="regular-text" value="" disabled> <label for="ecard_dropbox_private">Dropbox API Key</label>
                                    <br><small>Allow users to send images from their Dropbox accounts. Requires an <a href="https://www.dropbox.com/developers/dropins/chooser/js" rel="external">API key</a>.</small>
                                </p>
    		                </td>
    		            </tr>
    		            <tr class="ecards-pro-label">
    		                <th scope="row"><label for="ecard_redirection">Redirection settings</label> <span class="ecards-pro-icon">PRO</span></th>
    		                <td>
								<select name="ecard_redirection" id="ecard_redirection">
									<option value="0" selected>Do not redirect to another page</option>
									<option value="1">Redirect to another page (see below)</option>
								</select>
                                <br>
								<input name="ecard_page_thankyou" id="ecard_page_thankyou" type="url" class="regular-text" value="" placeholder="http://" disabled> <label for="ecard_page_thankyou">Page to redirect to</label>
                                <br><small>Use these options to customize your success actions and/or redirect to a &quot;Thank You&quot; page.</small>
    		                </td>
    		            </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_image_size">eCard image size<br><small>(default/recommended is <b>thumbnail</b>)</small></label></th>
    		                <td>
                                <?php $image_sizes = get_intermediate_image_sizes(); ?>
                                <select name="ecard_image_size" id="ecard_image_size">
                                    <option value="<?php echo get_option('ecard_image_size'); ?>"><?php echo get_option('ecard_image_size'); ?></option>
                                    <?php
                                    $options = get_option('ecard_image_size');
                                    $thumbsize = isset($options['thumb_size_box_select']) ? esc_attr( $options['thumb_size_box_select']) : '';
                                    $image_sizes = ecards_return_image_sizes();
                                    foreach($image_sizes as $size => $atts) { ?>
                                        <option value="<?php echo $size ;?>" <?php selected($thumbsize, $size); ?>><?php echo $size . ' - ' . implode('x', $atts); ?></option>
                                    <?php } ?>
                                </select>
                                <br><small>Add more image sizes using third-party plugins.</small>
                                <br><small><b>Note that adding custom sizes may require thumbnail regeneration.</b> We recommend <a href="https://wordpress.org/plugins/ajax-thumbnail-rebuild/">AJAX Thumbnail Rebuild</a> (free).</small>
    		                </td>
    		            </tr>
    		            <tr class="ecards-pro-label">
    		                <th scope="row"><label for="ecard_user_create">User creation settings</label> <span class="ecards-pro-icon">PRO</span></th>
    		                <td>
								<select name="ecard_user_create">
									<option value="0" selected>Do not create user on eCard sending</option>
									<option value="1">Create user on eCard sending</option>
								</select>
                                <br><small>If active, this option will create a new user with the "eCards Sender" role. This role is restricted and may be used to store users. Please disclose terms of service if you activate this option.</small>
    		                </td>
    		            </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_shortcode_fix">Content shortcode fix</label></th>
    		                <td>
                                <input name="ecard_shortcode_fix" id="ecard_shortcode_fix" type="checkbox"<?php if(get_option('ecard_shortcode_fix') === 'on') echo ' checked'; ?>> <label for="ecard_shortcode_fix">Apply</label>
                                <br><small>Only use this option if your WordPress version is old, or you have a buggy theme and the shortcode is not working.</small>
    		                </td>
    		            </tr>
    		        </tbody>
    		    </table>

                <hr>
                <p><input type="submit" name="info_settings_update" class="button button-primary" value="Save Changes"></p>
			</form>
		<?php } if($active_tab === 'ecards_payment') { ?>
			<form method="post" action="">
    			<h3 class="title"><?php _e('eCards Restrictions and Payment', 'ecards'); ?></h3>
                <p>Restricting access to members only does not require payment. It only requires a user to be logged into your WordPress site.</p>
                <p>If PayPal&trade; payment option is enabled, access to eCards will be available for 10 minutes after the payment process.</p>
    		    <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_restrictions">Member restrictions</label></th>
    		                <td>
								<select name="ecard_restrictions">
									<option value="0"<?php if(get_option('ecard_restrictions') === '0') echo ' selected'; ?>>Do not restrict access to eCard form</option>
									<option value="1"<?php if(get_option('ecard_restrictions') === '1') echo ' selected'; ?>>Restrict access to members only</option>
								</select> <label for="ecard_restrictions_message">Add a guest message below, if you restrict access to members only.</label>

								<?php wp_editor(get_option('ecard_restrictions_message'), 'ecard_restrictions_message', array('teeny' => true, 'textarea_rows' => 5, 'media_buttons' => false)); ?>
    		                </td>
    		            </tr>
    		            <tr class="ecards-pro-label">
    		                <th scope="row"><label for="p2v_who">PayPal&trade; payment</label> <span class="ecards-pro-icon">PRO</span></th>
    		                <td>
                                <p>
    								<select name="p2v_paypal_sandbox">
    									<option value="0" selected>Disable PayPal&trade; sandbox</option>
    									<option value="1">Enable PayPal&trade; sandbox</option>
    								</select>
                                </p>
    				            <p>
    								<select name="p2v_who" id="p2v_who">
    									<option value="0" selected>Request payment via PayPal&trade; from guests only (default)</option>
    									<option value="1">Request payment via PayPal&trade; from ALL users (both guests and members)</option>
    								</select>
                                    <br>
    
                                    <input name="p2v_paypal_button" id="p2v_paypal_button" type="url" class="regular-text" value="" disabled> <label for="p2v_paypal_button">PayPal&trade; Button Image URL</label>
                                    <br><small>Default is <b>https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif</b>. Find more buttons <a href="https://developer.paypal.com/docs/classic/api/buttons/" rel="external">here</a> and <a href="https://developer.paypal.com/docs/classic/archive/buttons/US-UK/" rel="external">here</a>.</small>
    								<br>
    								<input name="p2v_paypal_email" id="p2v_paypal_email" type="email" class="regular-text" value="" disabled> <label for="p2v_paypal_email">PayPal&trade; Email</label><br>
    								<input type="number" min="1" max="9999" step="0.01" name="p2v_paypal_default_amount" value="" disabled> <input name="p2v_paypal_currency" id="p2v_paypal_currency" type="text" size="3" value="" disabled> <label for="p2v_paypal_currency">PayPal&trade; Currency Code (e.g. USD, EUR, GBP)</label>
    								<br><small>PayPal&trade; amount can also be set when using the shortcode (e.g. <code>[paypal amount=8]</code>).</small>
    								<br><small>Read more about PayPal&trade; <a href="https://www.paypal.com/cgi-bin/webscr?cmd=p/sell/mc/mc_intro-outside" rel="external">accepted currencies</a> and <a href="https://developer.paypal.com/docs/classic/api/currency_codes/" rel="external">currency codes</a>.</small>
    				            </p>
    		                </td>
    		            </tr>
    		        </tbody>
    		    </table>

                <hr>
				<p><input type="submit" name="info_payment_update" class="button button-primary" value="Save Changes"></p>
			</form>
		<?php } if($active_tab === 'ecards_email') { ?>
    		<form method="post" action="">
    			<h3 class="title"><?php _e('Email Settings', 'ecards'); ?></h3>
                <p><b>Note:</b> To avoid your email adress being marked as spam, it is highly recommended that your "from" domain match your website. Some hosts may require that your "from" address be a legitimate address. Use a plugin to set custom <b>From Name</b> and <b>From Email</b> headers. We recommend <a href="https://wordpress.org/plugins/wp-mailfrom-ii/">WP Mail From II</a>.</p>
                <div class="postbox">
                    <div class="inside">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th scope="row"><label for="ecard_noreply">Dedicated email address</label></th>
                                    <td>
                                        <input name="ecard_noreply" id="ecard_noreply" type="email" class="regular-text" value="<?php echo get_option('ecard_noreply'); ?>">
                                        <br><small>Create a dedicated email address to use for sending eCards and prevent your messages landing in Spam/Junk folders.<br>Use <code>noreply@yourdomain.com</code>, <code>ecards@yourdomain.com</code> or something similar.</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_behaviour">Email behaviour</label></th>
    		                <td>
                                <select name="ecard_behaviour" class="regular-text">
                                    <option value="1"<?php if(get_option('ecard_behaviour') === '1') echo ' selected'; ?>>1. Show eCard inside email message (show link to source) (recommended)</option>
								    <option value="5"<?php if(get_option('ecard_behaviour') === '5') echo ' selected'; ?>>2. Show eCard inside email message (hide link to source)</option>
								    <option value="0"<?php if(get_option('ecard_behaviour') === '0') echo ' selected'; ?>>3. Hide eCard inside email message (show link to source)</option>
								    <option value="3"<?php if(get_option('ecard_behaviour') === '3') echo ' selected'; ?>>4. Show custom link (and use a link anchor)</option>
                                    <option value="2"<?php if(get_option('ecard_behaviour') === '2') echo ' selected'; ?>>5. Hide both eCard and link to source</option>
                                </select>
                                <br>&lfloor; <input name="ecard_link_anchor" type="text" class="regular-text" value="<?php echo get_option('ecard_link_anchor'); ?>"> <label>Link anchor *</label>
                                <br>&lfloor; <input name="ecard_body_footer" type="url" class="regular-text" value="<?php echo get_option('ecard_body_footer'); ?>" placeholder="http://"> <label>eCard (custom) URL *</label>
                                <br><small>If you select this option (4), the custom link will appear in the email message footer.</small>
                                <br><small>* Applies to <b>4</b>.</small>
				            </td>
				        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_send_behaviour">Sending behaviour</label></th>
    		                <td>
                                <select name="ecard_send_behaviour" class="regular-text">
									<option value="1"<?php if(get_option('ecard_send_behaviour') === '1') echo ' selected'; ?>>Require recipient email address</option>
									<option value="0"<?php if(get_option('ecard_send_behaviour') === '0') echo ' selected'; ?>>Hide recipient and send all eCards to the following email address</option>
								</select>
                                <br>&lfloor; <input name="ecard_hardcoded_email" type="email" class="regular-text" value="<?php echo get_option('ecard_hardcoded_email'); ?>">
								<br><small>If you want to send all eCards to a universal email address, select the option above and fill in the email address.</small>
				            </td>
				        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_title">Email subject</label></th>
    		                <td>
								<input name="ecard_title" id="ecard_title" type="text" class="regular-text" value="<?php echo get_option('ecard_title'); ?>">
								<br><small>This is the subject of the eCard email.</small>
				            </td>
				        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_body_additional">Email body</label></th>
    		                <td>
                                <?php wp_editor(get_option('ecard_body_additional'), 'ecard_body_additional', array('teeny' => true, 'textarea_rows' => 10, 'media_buttons' => false)); ?>
                                <br><small>This content will appear below the eCard image. Use it to promote your web site or to add custom links.</small>
				            </td>
				        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_body_toggle">Message area</label></th>
    		                <td>
                                <select name="ecard_body_toggle" id="ecard_body_toggle" class="regular-text">
									<option value="1"<?php if(get_option('ecard_body_toggle') === '1') echo ' selected'; ?>>Show message area (default)</option>
									<option value="0"<?php if(get_option('ecard_body_toggle') === '0') echo ' selected'; ?>>Hide message area</option>
								</select>
								<br><small>Show or hide the message textarea. Use it for &quot;Tip a friend&quot; type email message.</small>
				            </td>
				        </tr>
    		            <tr class="ecards-pro-label">
    		                <th scope="row"><label for="ecard_include_content">Post/page content</label> <span class="ecards-pro-icon">PRO</span></th>
    		                <td>
                                <select name="ecard_include_content" id="ecard_include_content" class="regular-text">
									<option value="1">Include post/page content</option>
									<option value="0" selected>Exclude post/page content (default)</option>
								</select>
								<br><small>Show or hide the post/page content. Useful if you have a certain eCard &quot;story&quot; or message you want to convey.</small>
				            </td>
				        </tr>
    		            <tr class="ecards-pro-label">
    		                <th scope="row"><label for="ecard_allow_cc">Carbon copy (CC)</label> <span class="ecards-pro-icon">PRO</span></th>
    		                <td>
                                <select name="ecard_allow_cc" id="ecard_allow_cc" class="regular-text">
									<option value="on">Allow sender to CC self</option>
									<option value="off" selected>Do not allow sender to CC self</option>
								</select>
								<br><small>Display a checkbox to allow the sender to CC self</small>
				            </td>
				        </tr>
				    </tbody>
				</table>

                <hr>
    			<p><input type="submit" name="info_email_update" class="button button-primary" value="Save Changes"></p>
			</form>
		<?php } if($active_tab === 'ecards_labels') { ?>
			<form method="post" action="">
    			<h3 class="title"><?php _e('Labels', 'ecards'); ?></h3>
    			<p>Use the labels to personalize or translate your eCards form.</p>
    		    <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_name_own">Your name<br><small>(input label)</small></label></th>
    		                <td>
                                <input name="ecard_label_name_own" id="ecard_label_name_own" type="text" class="regular-text" value="<?php echo get_option('ecard_label_name_own'); ?>">
                                <br><small>Default is "Your name"</small>
                            </td>
                        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_email_own">Your email address<br><small>(input label)</small></label></th>
    		                <td>
                                <input name="ecard_label_email_own" id="ecard_label_email_own" type="text" class="regular-text" value="<?php echo get_option('ecard_label_email_own'); ?>">
                                <br><small>Default is "Your email address"</small>
                            </td>
                        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_email_friend">Your friend's email address<br><small>(input label)</small></label></th>
    		                <td>
                                <input name="ecard_label_email_friend" id="ecard_label_email_friend" type="text" class="regular-text" value="<?php echo get_option('ecard_label_email_friend'); ?>">
                                <br><small>Default is "Your friend's email address"</small>
                            </td>
                        </tr>
    		            <tr>
    		                <th scope="row"><label for="ecard_label_message">eCard message<br><small>(textarea label)</small></label></th>
    		                <td>
                                <input name="ecard_label_message" id="ecard_label_message" type="text" class="regular-text" value="<?php echo get_option('ecard_label_message'); ?>">
                                <br><small>Default is "eCard message"</small>
                            </td>
                        </tr>
    		            <tr class="ecards-pro-label">
    		                <th scope="row"><label for="ecard_label_cc">Send a copy to self <span class="ecards-pro-icon">PRO</span><br><small>(checkbox label)</small></label></th>
    		                <td>
                                <p>
                                    <input name="ecard_label_cc" id="ecard_label_cc" type="text" class="regular-text" value="" disabled>
                                    <br><small>Default is "Send a copy to self"</small>
                                </p>
                            </td>
                        </tr>
    		            <tr >
    		                <th scope="row"><label for="ecard_submit">eCard submit<br><small>(button label)</small></label></th>
    		                <td>
                                <input id="ecard_submit"name=" ecard_submit" type="text" class="regular-text" value="<?php echo get_option('ecard_submit'); ?>">
                            </td>
                        </tr>
                    </tbody>
                </table>

				<hr>
				<p><input type="submit" name="info_labels_update" class="button button-primary" value="Save Changes"></p>
			</form>
		<?php } if($active_tab === 'ecards_diagnostics') { ?>
			<form method="post" action="">
    			<h3 class="title"><?php _e('Diagnostics', 'ecards'); ?></h3>
                <p>As the <code>wp_mail()</code> function is available after the 'plugins_loaded' hook, this option allows you to temporarily remove all existing filters. If you notice issues with other plugins, keep all existing <code>wp_mail()</code> filters. Try using <a href="https://wordpress.org/plugins/wp-mail-smtp/" rel="external">WP Mail SMTP</a> plugin (free) if <code>wp_mail()</code> is not working.</p>
    		    <table class="form-table">
    		        <tbody>
    		            <tr>
    		                <th scope="row"><label for="ecard_test_email">Test <code>wp_mail()</code> function</label></th>
    		                <td>
                                <input name="ecard_test_email" id="ecard_test_email" type="email" class="regular-text" value="<?php echo get_option('admin_email'); ?>">
                                <br><small>Use this address to send a test email message.</small>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <p><input type="submit" name="info_debug_update" class="button button-primary" value="Test/Save Changes"></p>
			</form>
		<?php } ?>
	</div>
<?php } ?>
