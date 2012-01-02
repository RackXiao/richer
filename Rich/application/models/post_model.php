<?php
class Post_model extends Abstract_basic_model  {
	function __construct() {
		parent::__construct();
	}
	
	var $table_name = 'Post';

	function getList($condition=array(), $cur_page=-1,  $order_by='createTime DESC') {
		$where_clauses = array();
		$where_binds = array();
		
		$where_str = '';
		if (count($where_clauses) > 0) {
			$where_str = 'WHERE '.join(' AND ', $where_clauses);
		}
		
		$limit = ( -1!=$cur_page ) ? "LIMIT ".($cur_page-1)*DATA_PER_PAGE.",".DATA_PER_PAGE : '';

		$sql = "SELECT 
					*
				FROM {$this->table_name} 
				$where_str 
				ORDER BY $order_by $limit";
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
