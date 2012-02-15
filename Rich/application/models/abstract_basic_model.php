<?php
class Abstract_basic_model extends CI_Model  {
	function __construct() {
		parent::__construct();
	}
	
	var $table_name;
	
	function setTableName($table_name) {
		$this->table_name = $table_name;
	}
	
	function getThisTableName() {
		return $this->table_name;
	}
	
	function getList($condition=array(), $cur_page=-1, $order_by = 'id DESC'){}
	
	function countGetList($condition = array()) {}
	
	function getBy($array){
		$this->db->where($array);
		return $this->db->get($this->table_name);
	}

	function getAll() {
		$this->db->order_by("arrange DESC, id DESC");
		return $this->db->get($this->table_name);
	}
	
	function insert($data, $hasFile=FALSE) {
		if($hasFile) {
			unset($data['image']);
			$image = upload_file($_FILES['image_file'], DIR_IMAGE);
			if(!empty($image))  $data['image'] = DIR_IMAGE.$image;
		}
		
		$qry = $this->getMaxArrange();
		$data['arrange'] = ($qry->num_rows()==0) ? 1 : $qry->row()->arrange + 1;
		
		return basic_db_insert($this->table_name, $data);
	}

	function update($data, $hasFile=FALSE) {
		if($hasFile) {
			unset($data['image']);
			$image = upload_file($_FILES['image_file'], DIR_IMAGE, array('id'=>$data['id'],'table_name'=>$this->table_name,'field'=>'image'));
			if(!empty($image))  $data['image'] = DIR_IMAGE.$image;
		}
		return basic_db_update($this->table_name, $data);
	}
	
	function delete($id_list, $hasFile=FALSE) {
		foreach ($id_list as $id) {
			if($hasFile) remove_file(array('id'=>$id,'table_name'=>$this->table_name,'field'=>'image'));
			$this->db->delete($this->table_name, array('id'=>$id));
		}
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

	function getMaxArrange() {
		$this->db->select_max('arrange');
		return $this->db->get($this->table_name);
	}
	
	function changeArrange($row, $option) {
		if ($option === '+') {
			$sql = "SELECT id, arrange FROM {$this->table_name} WHERE arrange = ( SELECT MIN(arrange) as arrange FROM {$this->table_name} WHERE  arrange > ?)";
		}
		if ($option === '-') {
			$sql = "SELECT id, arrange FROM {$this->table_name} WHERE arrange = ( SELECT MAX(arrange) as arrange FROM {$this->table_name} WHERE arrange < ?)";
		}
		
		$qry = $this->db->query($sql, array($row->arrange));
		if ($qry->num_rows() > 0 && isset($qry->row()->arrange)) {
			$this->update(array('id'=>$row->id, 'arrange'=>$qry->row()->arrange));
			$this->update(array('id'=>$qry->row()->id, 'arrange'=>$row->arrange));
		}
	}
}
