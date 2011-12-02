<?php
class Content_model extends Abstract_basic_model  {
	function __construct() {
		parent::__construct();
	}
	
	var $table_name = 'Content';

	function getList($condition=array(), $order_by='createTime DESC') {
		$where_clauses = array();
		$where_binds = array();
		
		// 帳號不分大小寫。
		if (isset($condition['account'])) {
			$where_clauses []= " UPPER(account) = UPPER(?) ";
			$where_binds [] = $condition['account'];
		}
		
		if (isset($condition['password'])) {
			$where_clauses []= " password = ? ";
			$where_binds [] = $condition['password'];
		}
		
		$where_str = '';
		if (count($where_clauses) > 0) {
			$where_str = 'WHERE '.join(' AND ', $where_clauses);
		}

		$sql = "SELECT 
					* 
				FROM {$this->table_name}  
				$where_str 
				ORDER BY $order_by";
		return $this->db->query($sql, $where_binds);
	}
	
	function countGetList($condition=array()) {
		$where_clauses = array();
		$where_binds = array();
	
		$where_str = '';
		if (count($where_clauses) > 0) {
			$where_str = 'WHERE '.join(' AND ', $where_clauses);
		}

		$sql = "SELECT 
					COUNT(id) count 
				FROM {$this->table_name} 
				$where_str";
		return $this->db->query($sql, $where_binds)->row()->count;
	}
}
