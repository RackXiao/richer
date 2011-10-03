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