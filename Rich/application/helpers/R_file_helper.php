<?php

/**
 * 安全的刪除檔案
 * 在刪檔之前，會先檢查檔案是否存在，如果檔案不存在，則不會刪除
 * @param $file
 * @return unknown_type
 */
function safety_unlink($file){
	if(file_exists($file) && is_file($file)){
		unlink($file);
	}
}

function filename_in_db($table, $column, $id, $local_filename){
	$tmp = explode("\.", $local_filename);
	$ext = $tmp[count($tmp)-1];
	return "{$table}-{$column}-".$id.".".$ext;
}

function random_filename($upload_filename) {
	if(stripos($upload_filename, ".") === FALSE) {
		return uuid();
	} else {
		$tmp = explode(".", $upload_filename);
		$ext = $tmp[count($tmp)-1];
		return uuid().".".$ext;
	}
}

function upload_file($file, $location, $update=array('id'=>'','table_name'=>'','field'=>'')) {
	if (isset($file) && $file['error'] == UPLOAD_ERR_OK) {
		$location = UPLOAD_PATH.$location;
		$folder = date('Y-m-d').'/';
		// 日期的資料匣存在判斷
		if (!is_dir($location.$folder)) mkdir($location.$folder, 0755);
		
		// 更新多一個刪除
		if(!empty($update['id'])) remove_file($update);
		
		$fileName = random_filename($file["name"]);
		
		// 把檔案移到上傳目錄
		move_uploaded_file($file["tmp_name"], $location.$folder.$fileName);
		
		return $folder.$fileName;
	}
}

function remove_file($img_row, $location='') {
	$CI = &get_instance();
	$location = UPLOAD_PATH.$location;
	safety_unlink($location.$CI->db->where("id", $img_row['id'])->get($img_row['table_name'])->row()->{$img_row['field']});
}
