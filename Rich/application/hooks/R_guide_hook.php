<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function develop_guide() {
	$CI = &get_instance();
	$CI->output->enable_profiler(IS_DEVELOPED);
}

/**
 * 檢查有無登入。
 */
/*
function login_guide() {
	date_default_timezone_set('Asia/Taipei');
	$CI = &get_instance();
	$URIs = array(
		'login',
		'logout',
		'analysis/writeOpenEmailRecord',
		'analysis/writeLinkRecord'
	);

	$count = 0;
	if ($CI->session->userdata('isLogin') != 1) {
		foreach($URIs as $URI) {
			if(stripos(uri_string(), $URI) !== FALSE) {
				$count++;
			}
		}
		
		if($count == 0) {
			$target_uri = assoc_to_segment(uri_string());
			if (("/" === uri_string()) || ("" === uri_string())) {
				$target_uri = assoc_to_segment('account');
			}
			$CI->session->set_userdata('alert_messages', array(lang('MSG_Member_PleaseLogin')));
			redirect('login/index/'.$target_uri);
		}
	} else {
		if (("/" === uri_string()) || ("" === uri_string())) {
			redirect('account');
		}
	}
}
*/
