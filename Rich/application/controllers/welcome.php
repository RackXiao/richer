<?php 
class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->test_model = setBasicModel('test');
	}
	
	public function index() {
		$data = array();
		
		$layout_data['content'] = $this->load->view('index', $data, TRUE);
		$this->load->view('layout/main', $layout_data);
	}
}
