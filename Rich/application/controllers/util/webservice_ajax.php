<?php
class Webservice_ajax extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('image_model');
		$this->image_model = new image_model();
		$this->load->model('image_category_model');
		$this->image_category_model = new image_category_model();
	}

	function index() {
		$data = array();
		$this->load->view('util/ck_file_browser', $data);
	}
	
	function get_image_type() {
		if (!isset($_POST['callback'])) {
			show_404();
		}
		$image_type_qry = $this->image_category_model->getAll();
		if ($image_type_qry->num_rows() > 0) {
			$image_type = $image_type_qry->result_array();
		} else {
			$image_type = array();
		}
//		$hash = array(array('id'=>SELECT_DontCare, 'title'=>SELECT_DontCare));
		$image_type_select_tag = select_tag($image_type, 'id', 'name', 'image_type', '', '', 'id="image_type_select_tag"');
		echo $_POST['callback']."(".json_encode(array(
			"image_type_select_tag"=>$image_type_select_tag
		)).")";
	}
	
	function get_images() {
		if (!isset($_POST['callback']) || !isset($_POST['ImageType_id'])) {
			show_404();
		}
		$this->session->set_userdata(array('ImageType_id'=>$_POST['ImageType_id']));
		
		$condition = array();
		$condition['search']["ImageType_id"] = $_POST['ImageType_id'];
		$images_qry = $this->image_model->getList($condition);
		if ($images_qry->num_rows() > 0) {
			$images = $images_qry->result_array();
		} else {
			$images = array();
		}
		echo $_POST['callback']."(".json_encode(array(
				"images"=>$images,
				"host"=>IMG_REMOTE_ADDRESS.INNER_DIR
		)).")";
	}
}