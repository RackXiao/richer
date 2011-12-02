<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('user_model');
		$this->user_model = new user_model();
		
		$data = array();
		$this->data = $data;
	}
	
	var $data;
	
// ================  以下主要呼叫區段  ================

	// 最新角色申請列表
	public function index() {
		$this->apply();
	}
	
	public function apply(){
		$data = $this->data;
		
		$this->_suffix($data, array('main_area'=>'apply'));
	}
	
	public function memberData(){
		$data = $this->data;
		
		$this->_suffix($data, array('main_area'=>'memberData'));
	}
	
	public function applyRecord(){
		$data = $this->data;
		
		$this->_suffix($data, array('main_area'=>'applyRecord'));
	}
	
	/*
	public function login(){
		$data = $this->data;
		
		if ( $this->_validateLoginData() ) {
			$User = $this->user_model->getUserByAccount($this->input->post("account"))->row_array();
			$Permission = $this->acl_model->getPermission($User['id']);
			
			// 設定 session。
			$login_data = array(
					'USER_ID'=>$User['id']
					,'USER_NAME'=>$User['name']
					,'USER_PERMISSION'=>$Permission
                   	,'IS_LOGIN'=>1
            	);
			$this->session->set_userdata($login_data);
			
			redirect('member');
		}
		
		$this->_suffix($data, array('main_area'=>'login'));
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect("welcome");
	}
	
	public function self(){
		$data = $this->data;
		
		if ( $this->_validateSelfData() ) {
			$this->user_model->update($_POST);
			
			$this->session->set_userdata(array('USER_NAME'=>$_POST['name']));
		}
		
		$data['User'] = $this->user_model->getUser($this->session->userdata('USER_ID'))->row_array();
		
		$this->_suffix($data, array('main_area'=>'self'));
	}*/
	
// ================  以下共用重覆部分  ================
	// 此模組相關的資料都由controller做初始
	// 資料處理完之後會到一個view, 架構會差不多，只差一個頁面，所以用此方式來管理，減少程式碼的修改
	private function _suffix($data, $diff=''){
		$layout_data['submenu'] = $this->load->view('member/submenu', $data, true);
		$layout_data['main_area'] = $this->load->view('member/admin/'.$diff['main_area'], $data, true);
		
		$layout_data['mainmenu'] = $this->load->view('layout/mainmenu', $data, true);
		$this->load->view('layout/main_layout', $layout_data);
	}
	
// ================  以下非關 view 的 function  ================
	
	/*
	private function _validateLoginData() {
		$this->form_validation->set_rules('account', '', 'trim|required|callback_validate_account_and_password[User]');
		$this->form_validation->set_rules('password', '', 'trim|required');
//		$this->form_validation->set_rules('authinput', '輸入驗證碼', 'trim|required|callback_validate_match[code_src]');
		return $this->form_validation->run();
	}
	
	// callback function 沒辦法用private
	function validate_account_and_password($account, $table){
		$this->form_validation->set_message("validate_account_and_password", "帳號密碼不符");
		$sql = "SELECT * FROM ".$table." WHERE account = ? AND password = ?";
		return get_instance()->db->query($sql, array($account, $_POST['password']))->num_rows() == 1;
	}
	
	private function _validateSelfData() {
		$this->form_validation->set_rules('name', '', 'trim|required');
		return $this->form_validation->run();
	}*/
}
