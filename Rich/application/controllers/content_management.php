<?php 
class Content_management extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('content_model');
		$this->content_model = new content_model();
	}
	
	public function index() {
		$data = array();
		$data['content'] = $this->content_model->getList()->result();
// 		var_dump($data['content']);
		
		$this->_suffix($data, array('content'=>'list'));
	}
	
	public function ajax_save() {
		if(!isset($_POST['id'])){
			$_POST['createTime'] = date('c');
			$this->content_model->insert($_POST);
		} else {
			$this->content_model->update($_POST);
		}
	}
	
	public function ajax_remove($id) {
		$this->content_model->delete(array($id));
	}
	
	private function _suffix($data, $diff=''){
		$layout_data['menu'] = $this->load->view('layout/memu', array(), TRUE);
		$layout_data['content'] = $this->load->view('content/'.$diff['content'], $data, TRUE);
		$this->load->view('layout/main', $layout_data);
	}
}
