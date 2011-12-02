<?php 
class Link_preview extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->test_model = setBasicModel('Link');
		
		echo getControllerCIPath(__FILE__);
		echo br(2);
		echo __FILE__;
		echo br(2);
	}
	
	public function index() {
		$data = array();
		$layout_data['menu'] = $this->load->view('layout/memu', array(), TRUE);
		$layout_data['content'] = $this->load->view('link', $data, TRUE);
		$this->load->view('layout/main', $layout_data);
	}
}
