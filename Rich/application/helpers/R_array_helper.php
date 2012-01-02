<?php

/**
 * 將 array( array(ka1=>va1, ka2=>va2, ...), array(kb1=>vb1, kb2=>vb2, ...), ..., )
 * 轉成 array( kax=>vay, kbx=>vby, ...)
 * 如果取不到 key 值或 value 值，就跳過
 * @param $array
 * @param $key_field 哪個欄位要當 key 值
 * @param $value_field 哪個欄位要當 value 值。若指定為 null 則使用整個 array 當 value
 * @return array($key => $value, ...)
 */
function array_to_assoc($array, $key_field, $value_field = null) {
	if(!is_array($array)) {
		return array();
	}
	$result = array();
	foreach($array as $arr) {
		if(!isset($arr[$key_field])) {
			continue;
		}
		if($value_field !== null) {
			if(!isset($arr[$value_field])) {
				continue;
			}
		}
		$result[$arr[$key_field]] = ($value_field !== null) ? $arr[$value_field] : $arr;
	}
	return $result;
}

/**
 * 將輸入的 array 只選取其中需要的欄位
 * @param $orginal_array
 * @param $available_keys
 * @return array
 */
function array_filter_key($orginal_array, $available_keys) {
	return array_intersect_key($orginal_array, array_flip($available_keys));
}

/**
 * 將輸入的 array 只選取DB有的欄位
 * @param $orginal_array
 * @param $db_name
 * @return array
 */
function array_filter_table($db_name, $orginal_array) {
	$CI = &get_instance();
	return array_filter_key($orginal_array, $CI->db->list_fields($db_name));
}

/**
 * 將定義在 constants.php 中且經過序列化的值轉回成 array，並依需求將轉回來的陣列與輸入的陣列合併。
 * @param $constant_name		常數名稱。
 * @param $merge_array			要合併的陣列。
 * @return array
 */
function constant_to_array($constant_name, $merge_array='') {
	$constant_array = unserialize($constant_name);
	
	if(is_array($merge_array)) {
		$result = array();
		// 重新組成新的陣列。
		while(list($key , $val) = each($merge_array)) {
			$result[$key]=$val;
		}
		while(list($key , $val) = each($constant_array)) {
			$result[$key]=$val;
		}
		return $result;
	}
	return $constant_array;
}

/**
 * 只取hash裡的某個column的值, 形成一個list
 * @param $hash_array		hash list array。
 * @param $column			要取的column。
 * @return a list array
 */
function hashlist_to_list($hash_array, $column) {
	$ret = array();
	foreach($hash_array as $item){
		$ret[] = $item[$column];
	}
	return $ret;
}