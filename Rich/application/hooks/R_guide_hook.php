<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function func_guide() {
	//== output profiler
	$develop = FALSE;
	if( isset($_GET['develop']) ) {
		if($_GET['develop']=='off'){
			$develop = FALSE;
			setcookie('develop','on',time()-30*60,'/');
		} else {
			$develop = TRUE;
			setcookie('develop','on',time()+30*60,'/');
		}
	} elseif ( isset($_COOKIE['develop']) ) {
		$develop = TRUE;
	}
	
	if($develop) develop_guide();
	//==
}

function develop_guide() {
	$CI = &get_instance();
	$URIs = array(
		'ajax',
	);
	$UseDevelop = TRUE;
	foreach($URIs as $URI) {
		if( stripos(uri_string(), $URI)!==FALSE ) {
			$UseDevelop =FALSE;
			break;
		}
	}
	$CI->output->enable_profiler($UseDevelop);
}

/**
 * 檢查有無登入。
 */
function login_guide() {
	$CI = &get_instance();
	$URIs = array(
		'admin',
		'login',
		'logout',
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
			$CI->session->set_userdata('alert_messages', array(lang('MSG_Member_PleaseLogin')));
			redirect('login/index/'.$target_uri);
		}
	}
}
function admin_login_guide() {
	$CI = &get_instance();
	$URIs = array(
		'login',
		'logout',
	);

	$count = 0;
	if ($CI->session->userdata('isAdminLogin') != 1) {
		foreach($URIs as $URI) {
			if(stripos(uri_string(), $URI) !== FALSE) {
				$count++;
			}
		}
		
		if($count == 0) {
			$target_uri = assoc_to_segment(uri_string());
			$CI->session->set_userdata('alert_messages', array(lang('MSG_Member_PleaseLogin')));
			redirect('admin/login/index/'.$target_uri);
		}
	}
}
