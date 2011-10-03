<?php 
class Link_preview extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->test_model = setBasicModel('Link');
		
		echo __FILE__;
	}
	
	public function index() {
		$data = array();
		$layout_data['menu'] = $this->load->view('layout/memu', array(), TRUE);
		$layout_data['content'] = $this->load->view('link', $data, TRUE);
		$this->load->view('layout/main', $layout_data);
	}
}
