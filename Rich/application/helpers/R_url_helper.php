<?php

function assoc_to_segment($array){
	return segment_encode(serialize($array));
}

function segment_to_assoc($segment){
	if ($segment === "-") {
		return array();
	}
	return unserialize(segment_decode($segment));
}

function segment_encode($str){
	$result = base64_encode($str);
	$result = str_replace("+", "-", $result);
	$result = str_replace("/", "_", $result);
	$result = str_replace("=", "", $result);
	return $result;
}

function segment_decode($str) {
	$result = str_replace("-", "+", $str);
	$result = str_replace("_", "/", $result);
	$num = strlen($result) % 4;
	for($i = 0; $i<(4-$num); $i++) {
		$result .= "=";
	}
	return base64_decode($result);
}

function replace_url($segment_array, $replace_index, $replace_value){
	$segment_array[$replace_index]=$replace_value;
	return site_url($segment_array);
}

function redirect_to($url){
	Header("HTTP/1.1 301 Moved Permanently");
	Header("Location:{$url}"); 
}

if ( ! function_exists('force_ssl'))
{
	function force_ssl()
	{
		$CI =& get_instance();
		$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
		
		if ($_SERVER['SERVER_PORT'] != 443)
		{
			redirect_to(site_url(uri_string()).getGETString());
		}
	}
}

/**
 * 給從ssl 出去的頁面回復正常的80 port
 */
function force_un_ssl()
{
	$CI =& get_instance();
	$CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);
	
	if ($_SERVER['SERVER_PORT'] != 80)
	{
		redirect_to(site_url(uri_string()).getGETString());
	}
}

// url中get參數保留
function getGETString(){
	$str_get = '';
	if(count($_GET) > 0){
		$str_get = '?';
		$i = 0;
		foreach($_GET as $k=>$v){
			if($i != 0){
				$str_get .= "&";
			}
			$str_get .= "{$k}={$v}";
			$i++;
		}
	}
	return $str_get;
}