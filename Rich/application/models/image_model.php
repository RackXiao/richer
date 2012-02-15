<?php
class Image_model extends Abstract_basic_model  {
	function __construct() {
		parent::__construct();
	}
	
	var $table_name = 'Image';

	function getList($condition=array(), $cur_page=-1, $order_by = 'id DESC'){
		$where_clauses = array();
		$where_binds = array();
		$limit = " ";
	
		if (isset($condition['search'])) {
			if(isset($condition['search']["ImageType_id"]) && trim(element("ImageType_id", $condition['search'])) !== '') {
				$where_clauses []= " ImageCategory_id = ? ";
				$where_binds [] = $condition['search']["ImageType_id"];
			}
		}
		
		$where_str = '';
		if (count($where_clauses) > 0) {
			$where_str = 'WHERE '.join(' AND ', $where_clauses);
		}
		
		if( -1!=$cur_page ){
			$limit .= "LIMIT ".($cur_page-1)*ROWS_PER_PAGE.",".ROWS_PER_PAGE;
		}
		
		$sql = "SELECT 
					*
				FROM {$this->table_name} 
				$where_str 
				ORDER BY $order_by $limit";
		return $this->db->query($sql, $where_binds);
	}
	
	function countGetList($condition = array()) {
		$where_clauses = array();
		$where_binds = array();
	
		if (isset($condition['search'])) {
			if(isset($condition['search']["ImageType_id"]) && trim(element("ImageType_id", $condition['search'])) !== '') {
				$where_clauses []= " ImageCategory_id = ? ";
				$where_binds [] = $condition['search']["ImageType_id"];
			}
		}
		
		$where_str = '';
		if (count($where_clauses) > 0) {
			$where_str = 'WHERE '.join(' AND ', $where_clauses);
		}

		$sql = "SELECT COUNT(*) count FROM {$this->table_name} $where_str";
		return $this->db->query($sql, $where_binds)->row()->count;
	}
	
	function insert($data) {
		unset($data['image']);
		
		$data = array_filter_table($data, $this->table_name);
		
		foreach($_FILES as $file){
			$image = upload_file($file, $this->img_dir);
			if(!empty($image)) {
				$data['image'] = $image;
				$is_success = $this->db->insert($this->table_name, $data);
			}
		}
		
		if (!$is_success) {
			return 0;
		}
		$new_data_id = $this->db->insert_id();
		return $new_data_id;
	}

	function update($data) {
		unset($data['image']);
		
		$data = array_filter_table($data, $this->table_name);
		
		$image = upload_file($_FILES['image_file'], DIR_IMAGE, array('id'=>$data['id'],'table_name'=>$this->table_name,'field'=>'image'));
		if(!empty($image))  $data['image'] = DIR_IMAGE.$image;

		return $this->db->update($this->table_name, $data, array('id'=>$data['id']));
	}
	
	function delete($id_list) {
		foreach ($id_list as $id) {
			//刪除舊檔
			remove_file($this->img_dir, array('id'=>$id,'table_name'=>$this->table_name,'field'=>'image'));
			$this->db->delete($this->table_name, array('id'=>$id));
		}
	}
}
