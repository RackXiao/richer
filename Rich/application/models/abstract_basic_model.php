<?php
class Abstract_basic_model extends CI_Model  {
	function __construct() {
		parent::__construct();
	}
	
//	function getList($condition=array(), $cur_page=-1, $order_by = 'id DESC'){
//		
//	}
//	
//	function countGetList($condition = array()) {
//		
//	}
	
	function getBy($field, $value) {
		$this->db->where($field, $value); 
		return $this->db->get($this->table_name);
	}

	function getAll() {
		$sql = "SELECT * FROM {$this->table_name} ORDER BY arrange DESC, id DESC";
		return $this->db->query($sql);
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

	function changeStatus($id_list, $status) {
		$this->changeFieldStatus($id_list, 'enable', $status);
	}

	function changeFieldStatus($id_list, $filed, $status) {
		foreach($id_list as $id){
			$data = array();
			$data['id'] = $id;
			$data[$filed] = $status;
			$this->update($data);
		}
	}

	function inverseFieldStatus($id_list, $filed) {
		foreach($id_list as $id){
			$sql = "UPDATE {$this->table_name} 
					SET {$filed} = IF({$filed}='1', '0', '1')
					WHERE id = ?";
			$this->db->query($sql, $id);
		}
	}

//=== getMaxArrange 需要帶參數的話，以下兩個都要重寫 ===
	function getMaxArrange() {
		$this->db->select_max('arrange');
		return $this->db->get($this->table_name);
	}
	
	function changeArrange($row, $option) {
		if ($option === '+') {
			$sql = "SELECT * FROM {$this->table_name} WHERE  arrange = (SELECT MIN(arrange) as arrange FROM {$this->table_name} WHERE  arrange > ?)";
		}
		if ($option === '-') {
			$sql = "SELECT * FROM {$this->table_name} WHERE  arrange = (SELECT MAX(arrange) as arrange FROM {$this->table_name} WHERE  arrange < ?)";
		}
		
		$qry = $this->db->query($sql, array($row->arrange));
		if ($qry->num_rows() > 0 && isset($qry->row()->arrange)) {
			$this->update(array('id'=>$row->id, 'arrange'=>$qry->row()->arrange));
			$this->update(array('id'=>$qry->row()->id, 'arrange'=>$row->arrange));
		}
	}
}
