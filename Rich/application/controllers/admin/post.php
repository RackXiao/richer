<?php 
class Post extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('post_model');
		$this->post_model = new post_model();
	}
	
	var $controller = 'admin/post';
	
	function index($page_num=1, $query_string='-') {
		if ($query_string === '-') {
			$conditions = array();
			$query_string = assoc_to_segment($conditions);
		} else {
			$conditions = segment_to_assoc($query_string);
		}
		
		$data = array();
		$data['page_num'] = $page_num;
		$data['query_string'] = $query_string;
		
		$data['list'] = $this->post_model->getList($conditions, $page_num)->result();
	
		$pager_param = pager_param(
			"{$this->controller}/index/%s/{$query_string}",
			intval($page_num),
			$this->post_model->countGetList($conditions),
			DATA_PER_PAGE
		);
		$data['pager_str'] = $this->load->view('util/pager', $pager_param, true);
		
		$this->_suffix($data, array('content'=>'list'));
	}
	
	function dispatch() {
		$page_num = $this->input->post('page_num');
		$query_string = $this->input->post('query_string');
	
		if ($this->input->post('new_btn')) {
			redirect("{$this->controller}/newProcess/{$page_num}/{$query_string}");
		}
		if ($this->input->post('delete_btn')) {
			$this->deleteProcess();
		}
		if ($this->input->post('enable_btn')) {
			$this->enableProcess();
		}
		if ($this->input->post('disable_btn')) {
			$this->disableProcess();
		}
		
		show_404();
	}

	function newProcess($page_num=1, $query_string='-') {
		if ($this->_validateSaveData()) {
			$_POST['createTime'] = date('c');
			$insert_id = $this->post_model->insert($_POST);
			if ($insert_id > 0) {
				$this->session->set_userdata('alert_messages', array(lang('new_success')));
			}
			redirect("{$this->controller}/index/{$page_num}/{$query_string}");
		}

		$data = array();
		$data['page_num'] = $page_num;
		$data['query_string'] = $query_string;
		
		$this->_suffix($data, array('content'=>'save'));
	}

	function _validateSaveData() {
		if($this->input->post('id')){
			$this->form_validation->set_rules('id', '', 'trim|required|intager|valid_id[Post]');
		}
		$this->form_validation->set_rules("image", '', 'trim|is_allowed_image');
		$this->form_validation->set_rules('description', '', 'trim');
		return $this->form_validation->run();
	}

	function editProcess($id=-1, $page_num=1, $query_string='') {
		$qry = $this->post_model->getBy('id', $id);
		if ($qry->num_rows() == 0) {
			show_404();
		}
		
		if ($this->_validateSaveData()) {
			$this->post_model->update($_POST);
			$this->session->set_userdata('alert_messages', array(lang('update_success')));
		}
		
		$data = array();
		$data['page_num'] = $page_num;
		$data['query_string'] = $query_string;
		
		$data['item'] = $this->post_model->getBy('id', $id)->row();
		
		$this->_suffix($data, array('content'=>'save'));
	}

	function deleteProcess() {
		if ($this->_validateDeleteData()) {
			$this->post_model->delete($this->input->post('id_list'));
		}
		redirect("{$this->controller}/index/{$this->input->post('page_num')}/{$this->input->post('query_string')}");
	}

	function _validateDeleteData(){
		$this->form_validation->set_rules('id_list[]', '', 'trim|required|valid_id[Post]');
		return $this->form_validation->run();
	}
	
	
	public function ajax_save() {
		if(!isset($_POST['id'])){
			$_POST['createTime'] = date('c');
			$this->post_model->insert($_POST);
		} else {
			$this->post_model->update($_POST);
		}
	}
	
	public function ajax_remove($id) {
		$this->post_model->delete(array($id));
	}
	
	private function _suffix($data, $diff=''){
		$data['controller'] = $this->controller;
		$data['group_name'] = M_G_POST;
		$data['manage_name'] = M_POST;
		$data['sub_content'] = $this->load->view('admin/post/'.$diff['content'], $data, TRUE);
		
		$layout_data['content'] = $this->load->view('layout/crud/'.$diff['content'], $data, TRUE);
		$this->load->view('layout/back_main', $layout_data);
	}
	protected function enableProcess() {
		$result = $this->post_model->changeFieldStatus($this->input->post('id_list'), 'enable', '1');
		redirect("{$this->controller}/index/{$this->input->post("page_num")}/{$this->input->post('query_string')}");
	}

	protected function disableProcess() {
		$result = $this->post_model->changeFieldStatus($this->input->post('id_list'), 'enable', '0');
		redirect("{$this->controller}/index/{$this->input->post("page_num")}/{$this->input->post('query_string')}");
	}
}
