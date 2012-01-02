<?php
class Broth extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('broth_model');
		$this->broth_model = new broth_model();
		
		$this->load->model('broth_category_model');
		$this->broth_category_model = new broth_category_model();
	}
	
	var $controller = 'broth';
	
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
		
		$data['list'] = $this->broth_model->getList($conditions, $page_num)->result();
		
		$pager_param = pager_param(
			"admin/{$this->controller}/index/%s/{$query_string}",
			intval($page_num),
			$this->broth_model->countGetList($conditions),
			ROWS_PER_PAGE
		);
		$data['pager_str'] = $this->load->view('util/pager', $pager_param, true);
		
		$this->_sufix($data, array('main_area'=>'list'));
	}
	
	function dispatch() {
		$page_num = $this->input->post('page_num');
		$query_string = $this->input->post('query_string');
	
		if ($this->input->post('new_btn')) {
			redirect("admin/{$this->controller}/newProcess/{$page_num}/{$query_string}");
		}
		if ($this->input->post('enable_btn')) {
			$this->enableProcess();
		}
		if ($this->input->post('disable_btn')) {
			$this->disableProcess();
		}
		if ($this->input->post('delete_btn')) {
			$this->deleteProcess();
		}
		if ($this->input->post('move_upper_btn')) {
			$key = array_keys($this->input->post('move_upper_btn'));
			$this->moveUpperProcess($key[0]);
		}
		if ($this->input->post('move_lower_btn')) {
			$key = array_keys($this->input->post('move_lower_btn'));
			$this->moveLowerProcess($key[0]);
		}
		
		show_404();
	}

	function newProcess($page_num=1, $query_string='-') {
		if ($this->_validateNewData()) {
			$insert_id = $this->broth_model->insert($_POST);
			if ($insert_id > 0) {
				$this->session->set_userdata('alert_messages', array(lang('new_success')));
			}
			redirect("admin/{$this->controller}/index/{$page_num}/{$query_string}");
		}

		$data = array();
		$data['page_num'] = $page_num;
		$data['query_string'] = $query_string;
		
		$this->_sufix($data, array('main_area'=>'new'));
	}

	function _validateNewData() {
		$this->form_validation->set_rules('BrothCategory_id', '', 'trim|required|intager|valid_id[BrothCategory]');
		$this->form_validation->set_rules("image", '', 'trim|is_allowed_image');
		$this->form_validation->set_rules('description', '', 'trim');
		return $this->form_validation->run();
	}

	function editProcess($id=-1, $page_num=1, $query_string='') {
		$db_query = $this->broth_model->getBy('id', $id);
		if ($db_query->num_rows() == 0) {
			show_404();
		}
		
		if ($this->_validateEditData()) {
			$this->broth_model->update($_POST);
			$this->session->set_userdata('alert_messages', array(lang('update_success')));
		}
		
		$data = array();
		$data['page_num'] = $page_num;
		$data['query_string'] = $query_string;
		
		$data['item'] = $this->broth_model->getBy('id', $id)->row();
		
		$this->_sufix($data, array('main_area'=>'edit'));
	}

	function _validateEditData() {
		$this->form_validation->set_rules('id', '', 'trim|required|intager|valid_id[Broth]');
		$this->form_validation->set_rules('BrothCategory_id', '', 'trim|required|intager|valid_id[BrothCategory]');
		$this->form_validation->set_rules("image", '', 'trim|is_allowed_image');
		$this->form_validation->set_rules('description', '', 'trim');		
		return $this->form_validation->run();
	}
	
	function deleteProcess() {
		if ($this->_validateDeleteData()) {
			$this->broth_model->delete($this->input->post('id_list'));
		}
		redirect("admin/{$this->controller}/index/{$this->input->post('page_num')}/{$this->input->post('query_string')}");
	}

	function _validateDeleteData(){
		$this->form_validation->set_rules('id_list[]', '', 'trim|required|valid_id[Broth]');
		return $this->form_validation->run();
	}
	
	function _sufix($data, $diff) {
		$data['category'] = array_to_assoc($this->broth_category_model->getAll()->result_array(),'id','name');
		
		$data['controller'] = $this->controller;
		$data['management_name'] = '獨門湯底';
		
		$layout_data['main_area'] = $this->load->view("admin/{$this->controller}/{$diff['main_area']}", $data, true);
		$this->load->view('layout/backend', $layout_data);
	}

	protected function enableProcess() {
		$result = $this->broth_model->changeFieldStatus($this->input->post('id_list'),'enable','1');
		redirect("admin/{$this->controller}/index/{$this->input->post('page_num')}/{$this->input->post('query_string')}");
	}

	protected function disableProcess() {
		$result = $this->broth_model->changeFieldStatus($this->input->post('id_list'),'enable','0');
		redirect("admin/{$this->controller}/index/{$this->input->post('page_num')}/{$this->input->post('query_string')}");
	}

	protected function moveUpperProcess($id) {
		$this->broth_model->changeArrange($this->broth_model->getBy('id', $id)->row(), '+');
		redirect("admin/{$this->controller}/index/{$this->input->post('page_num')}/{$this->input->post('query_string')}");
	}

	protected function moveLowerProcess($id) {
		$this->broth_model->changeArrange($this->broth_model->getBy('id', $id)->row(), '-');
		redirect("admin/{$this->controller}/index/{$this->input->post('page_num')}/{$this->input->post('query_string')}");
	}
}