<?php 
class TimeLine extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->time_model = setBasicModel('TimeLine');
	}
	
//	public function index() {
//		$data = array();
//		$timeLine = $this->time_model->getAll('create_date')->result_array();
//		$data['TimeLine'] = array();
//		foreach ($timeLine as $row) {
//			$data['TimeLine'][date('Y',strtotime($row['create_date']))][] = $row;
//		}
//		
//		$layout_data['menu'] = $this->load->view('layout/memu', array(), TRUE);
//		$layout_data['content'] = $this->load->view('timList', $data, TRUE);
//		$this->load->view('layout/main', $layout_data);
//	}
}
