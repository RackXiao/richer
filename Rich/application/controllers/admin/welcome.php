<?php 
class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function index() {
		$data = array();
		
		$layout_data['content'] = $this->load->view('admin/index', $data, TRUE);
		$this->load->view('layout/back_main', $layout_data);
	}
}
