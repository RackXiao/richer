<?php
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
// 		$this->load->model('admin_model');
// 		$this->admin_model = new admin_model();
	}
	
	function index($uri='') {
		$target_uri = "admin/welcome";
		
		if (strlen($uri) > 0) {
			$target_uri = segment_to_assoc($uri);
		}
		
		if ($this->session->userdata('isAdminLogin') == 1) {
			redirect($target_uri);
		}
		
		if ($this->_validateLoginData()) {
			// 設定 session。
			$login_data = array(
					'account'=>$_POST['account'],
                   	'isAdminLogin'=>1
            		);
			$this->session->set_userdata($login_data);
			// 
			$this->session->set_userdata('alert_messages', array(lang('login_success')));
			redirect($target_uri);
		}
		
		// 設定給 view 顯示的東西。
		$this->load->view('layout/back_login');
	}

	function _validateLoginData() {
		$this->form_validation->set_message('account_check', lang('MSG_AdminLogin_Failure'));
		
		$this->form_validation->set_rules('account', '', 'trim|required');
		$this->form_validation->set_rules('password', '', 'trim|required|callback_account_check');
		return $this->form_validation->run();
	}
	
	function account_check($str) {
		if ($_POST['account'] == 'admin' && $_POST['password'] == '123') {
			return TRUE;
		}
		return false;
	}
}