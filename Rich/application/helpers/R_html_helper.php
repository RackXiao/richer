<?php

/**
 * 將 字串編碼為 html 碼
 * @param $str
 * @return string html code
 */
function html_encode($str) {
	return htmlspecialchars($str, ENT_NOQUOTES);
}
/**
 * 產生 select 選單
 * @param $hashArray			Query 所得的 result_array()。
 * @param $key					$hashArray 中某個欄位，用來產生 select tag 的 key 值。
 * @param $name					$hashArray 中某個欄位，用來產生 select tag 的 name 值。
 * @param $select_name			select tag 的 name。
 * @param $default_value		select tag 中預設選取的值。
 * @param $insert_top_hash		要新增的額外選項，會新增至 select tag 的開頭。
 * @param $extra				select tag 其他要增加的屬性。
 * @return html					select tag
 */
function select_tag($hashArray, $key, $name, $select_name, $default_value, $insert_top_hash,  $extra=''){
	if(is_array($insert_top_hash)){
		foreach($insert_top_hash as $hash) {
			array_unshift($hashArray, $hash);
		}
	}
	$options = array_to_assoc($hashArray, $key, $name);
	return form_dropdown($select_name, $options, set_value($select_name, $default_value), $extra);
}

/**
 * 因為 CI 的 set_checkbox 程式碼有點怪異，造成目前使用上，都是回傳空字串，
 * 而不會回傳 ' checked="checked"'，等於是廢了，因此作點小更動，基本上大致照抄 set_checkbox 的程式碼。
 * @param $field
 * @param $value
 * @param $default
 */
function set_checkbox_checked($field = '', $value = '', $default){
	if(!is_array($default)) {
		$default = array();	
	}
	
	if ( ! isset($_POST[$field]))
	{
		if (count($_POST) === 0)
		{
			if ( ! in_array($value, $default))
			{
				return '';
			}
			return ' checked="checked"';
		}
		return '';
	}

	$field = $_POST[$field];
	
	if (is_array($field))
	{
		if ( ! in_array($value, $field))
		{
			return '';
		}
	}
	else
	{
		if (($field == '' OR $value == '') OR ($field != $value))
		{
			return '';
		}
	}

	return ' checked="checked"';
}