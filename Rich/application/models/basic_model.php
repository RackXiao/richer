<?php
class Basic_model extends CI_Model  {
	function __construct() {
		parent::__construct();
	}
	
	function setTableName($table_name) {
		$this->table_name = $table_name;
	}
	
	function getThisTableName() {
		return $this->table_name;
	}
	
	function getAll($orderBy='id DESC') {
		$sql = "SELECT * FROM {$this->table_name} ORDER BY {$orderBy}";
		return $this->db->query($sql);
	}
	
	function getBy($array){
		$this->db->where($array);
		return $this->db->get($this->table_name);
	}
	
	function insert($data) {
		return basic_db_insert($this->table_name, $data);
	}
	
	function update($data) {
		return basic_db_update($this->table_name, $data);
	}
	
	function delete($id_list) {
		foreach ($id_list as $id) {
			$this->db->delete($this->table_name, array('id'=>$id));
		}
	}
}
