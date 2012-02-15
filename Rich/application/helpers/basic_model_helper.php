<?php
function setBasicModel($model_name){
	$CI = &get_instance();
	$CI->load->model('abstract_basic_model');
	$CI->model = new abstract_basic_model();
	$CI->model->setTableName($model_name);
	
	return $CI->model;
}
