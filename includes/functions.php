<?php
function ecards_save() {
    global $wpdb;

    $ecards_stats_table = $wpdb->prefix . 'ecards_stats';
    $ecards_stats_now = date('Y-m-d');
    $cards_sent = 0;

    $wpdb->query("INSERT INTO $ecards_stats_table (date, sent) VALUES ('$ecards_stats_now', $cards_sent) ON DUPLICATE KEY UPDATE sent = sent + 1");

	$ecard_counter = get_option('ecard_counter');
    update_option('ecard_counter', ($ecard_counter + 1));
}

function ecards_return_image_sizes() {
    global $_wp_additional_image_sizes;

    $image_sizes = array();
    foreach(get_intermediate_image_sizes() as $size) {
        $image_sizes[$size] = array(0, 0);
        if(in_array($size, array('thumbnail', 'medium', 'large'))) {
            $image_sizes[$size][0] = get_option($size . '_size_w');
            $image_sizes[$size][1] = get_option($size . '_size_h');
        }
        else 
            if(isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$size]))
                $image_sizes[$size] = array($_wp_additional_image_sizes[$size]['width'], $_wp_additional_image_sizes[$size]['height']);
    }
    return $image_sizes;
}

function ecard_checkSpam($content) {
	// innocent until proven guilty
	$isSpam = FALSE;
	$content = (array)$content;

	if(function_exists('akismet_init') && get_option('ecard_use_akismet') == 'true') {
		$wpcom_api_key = get_option('wordpress_api_key');

		if(!empty($wpcom_api_key)) {
			global $akismet_api_host, $akismet_api_port;

			// set remaining required values for akismet api
			$content['user_ip'] = preg_replace('/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR']);
			$content['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$content['referrer'] = $_SERVER['HTTP_REFERER'];
			$content['blog'] = get_option('home');

			if(empty($content['referrer'])) {
				$content['referrer'] = get_permalink();
			}

			$queryString = '';

			foreach($content as $key => $data) {
				if(!empty($data)) {
					$queryString .= $key . '=' . urlencode(stripslashes($data)) . '&';
				}
			}

			$response = Akismet::http_post($queryString, 'comment-check');

			if($response[1] == 'true') {
				update_option('akismet_spam_count', get_option('akismet_spam_count') + 1);
				$isSpam = TRUE;
			}
		}
	}
	return $isSpam;
}
?>
