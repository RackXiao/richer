<?php


/**
 * 把字串當中 html 的 tag 統統拿掉（沒有嚴格測試過）
 * @param $string
 * @return unknown_type
 */
function html_to_text($string){
	return preg_replace("/(<.+?>)*?/", "", $string);
}

function abstract_text($string, $length, $more_str = "..."){
	if(mb_strlen($string, "UTF-8")<=$length){
		return $string;
	}
	return mb_substr($string, 0, $length).$more_str;
}

function uuid(){
	return md5(uniqid(rand(), true));
}

/**
 * str_replace會取代文件所有符合的字串
 * 而此function只做1次str_replace
 * @param str $needle 將被搜尋的字串
 * @param str $replace 取代成為此字串
 * @param str $haystack 取代的內容
 */
function str_replace_once($needle , $replace , $haystack) {
	// Looks for the first occurence of $needle in $haystack
	// and replaces it with $replace.
	$pos = strpos($haystack, $needle);
	if ($pos === false) {
		// Nothing found
		return $haystack;
	}
	return substr_replace($haystack, $replace, $pos, strlen($needle));
}

function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    $start  = $length * -1; //negative
    return (substr($haystack, $start) === $needle);
}
