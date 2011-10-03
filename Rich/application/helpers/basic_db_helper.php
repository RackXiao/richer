<?php

/**
 * 將資料新增至DB（基本款）
 * @param string $table_name
 * @param hash_array $insert_data
 */
function basic_db_insert($table_name, $insert_data){
	$CI = &get_instance();

	$insert_data = array_filter_table($insert_data, $table_name);
	
	$is_success = $CI->db->insert($table_name, $insert_data);
	if (!$is_success) {
		return 0;
	} 
	
	$new_data_id = $CI->db->insert_id();
	return $new_data_id;
}

/**
 * 將資料更新至DB（基本款）
 * @param string $table_name
 * @param hash_array $update_data 必需含有id
 */
function basic_db_update($table_name, $update_data){
	if(!isset($update_data['id'])){
		return FALSE;
	}
	$CI = &get_instance();

	$update_data = array_filter_table($update_data, $table_name);
	
	return $CI->db->update($table_name, $update_data, array('id'=>$update_data['id']));
}