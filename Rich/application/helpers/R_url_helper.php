<?php

/**
 * url中get參數保留
 */
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

/**
 * 取得目前controller所在的ci uristring
 * @param str $file
 * @return string
 */
function getControllerCIPath($file){
	$str = basename($file, '.php');
	$path = explode(SPLASH, dirname($file));
	while($path[count($path)-1]!='controllers'){
		$str = $path[count($path)-1].'/'.$str;
		unset($path[count($path)-1]);
	}
	return $str;
}

/**
* 加密 array to str
* @param ary $array
* @return mixed
*/
function assoc_to_segment($array){
	return segment_encode(serialize($array));
}

/**
 * 解密 str to array
 *   字串為 - 時，回傳空array
 * @param str $segment
 * @return multitype:|mixed
 */
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

function redirect_to($url){
	Header("HTTP/1.1 301 Moved Permanently");
	Header("Location:{$url}"); 
}

/**
 * 未用到
 * @param ary $segment_array
 * @param str $replace_index
 * @param str $replace_value
 */
function replace_url($segment_array, $replace_index, $replace_value){
	$segment_array[$replace_index]=$replace_value;
	return site_url($segment_array);
}

/**
 * ssl的連結，將base_url改為 port 443，http to https
 */
function force_ssl()
{
	$CI =& get_instance();
	$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
	
	if ($_SERVER['SERVER_PORT'] != 443)
	{
		redirect_to(site_url(uri_string()).getGETString());
	}
}

/**
 * 在ssl的base_url回 port 80，https to http
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