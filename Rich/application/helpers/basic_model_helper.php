<?php
function setBasicModel($model_name){
	$CI = &get_instance();
	$CI->load->model('basic_model');
	$CI->basic_model = new basic_model();
	$CI->basic_model->setTableName($model_name);
	
	return $CI->basic_model;
}
