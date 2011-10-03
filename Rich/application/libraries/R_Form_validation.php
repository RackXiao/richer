<?php
/**
 * 必須先 set_rule() 之後才能 set_message()
 */
class R_Form_validation extends CI_Form_validation {
	function __construct () {
		parent::__construct();
		$this->load_rule_messages();
	}

	function load_rule_messages() {
		$this->set_message("is_grater_than", "The %s filed must grater than %s.");
		$this->set_message("is_grater_than_or_equal_to", "The %s filed must >= %s.");
		$this->set_message("is_less_than", "The %s filed must less than %s.");
		$this->set_message("is_less_than_or_equal_to", "The %s filed must <= %s.");
		$this->set_message("is_equal_to", "The %s filed must equal to %s.");
		$this->set_message("valid_id", "The id %s in table %s doesn't exist.");
		$this->set_message("is_float_great_than_zero", "The %s must grater than zero and be a float.");
		$this->set_message("valid_mobile_phone", "行動電話格式不正確");
		$this->set_message("valid_phone", "連絡電話格式不正確");
		$this->set_message("valid_identity_code", "格式不正確");
		$this->set_message('integer', '此欄位只能打數字！');
		
		$this->set_message("required", "此欄位必填");
		$this->set_message("is_allowed_image", "上傳的副檔名必須是 .jpg, .png, .gif ");
		$this->set_message("max_filesize", "上傳的檔案超過限製大小");
		$this->set_message("file_upload_required", "必須上傳檔案");
		$this->set_message("image_ratio", "照片不合比例，請確認照片比例另行上傳");
		$this->set_message("valid_primary_column", "The column value %s in table %s doesn't exist.");
		
		$this->set_message("valid_email", "Email 格式錯誤。");
		
		// XXX 訊息要修改
		$this->set_message("matches_table_column", "密碼錯誤");
		$this->set_message('date_check', '日期格式不對！');
		$this->set_message('max_value', 'The %s filed must <= %s.');
		$this->set_message('min_value', 'The %s filed must >= %s.');
	}
	
	function valid_mobile_phone($str) {
		if($str === '') {
			return true;
		}
		
		$pattern = "/^[0-9]{10}$/";
		$result = preg_match($pattern, $str);
		if( $result > 0) {
			return true;
		}
		return false;
	}
	
	function valid_phone($str) {
		$pattern = "/^[0-9]+\\-[0-9]+$/";
		$result = preg_match($pattern, $str);
		if( $result > 0) {
			return true;
		}
		return false;
	}
		
	function matches_password($str, $field)
	{
		if ( ! isset($_POST[$field]["password"]))
		{
			return FALSE;
		}

		return ($str === $_POST[$field]["password"]);
	}

	function valid_account($account) {
		$pattern = "/^[a-zA-Z0-9_\!]*$/";
		$result = preg_match($pattern, $account);
		if( $result > 0) {
			return true;
		}
		return false;
	}

	function valid_zip($zip) {
		$pattern = "/^[0-9]*$/";
		$result = preg_match($pattern, $zip);
		if( $result > 0) {
			return true;
		}
		return false;
	}

	function valid_password($password) {
		$pattern = "/^[a-zA-Z0-9_\!\@\#\$\%\^\&\*\(\)]*$/";
		$result = preg_match($pattern, $password);
		if( $result > 0) {
			return true;
		}
		return false;

	}
	
	//XXX 暫用 到時要改
	function matches_table_column($str, $param)
	{
		$params = explode(";", $param);
		
		if(count($params)==2){
			$sql = "select * from ".$params[0]." where ".$params[1]." = ?";
			return get_instance()->db->query($sql, array(md5($str)))->num_rows()>0;
		} else {
			return FALSE;
		}
	}

	/**
	 * 查看輸入的字串是否是合法的
	 * @param $input
	 * @param $values 合法值以逗號分隔連起來成一個字串
	 * @return bool
	 */
	function valid_values($input, $values_str) {
		$values = explode(',', $values_str);
		return in_array($input, $values);
	}

	/**
	 * 是否大於某數
	 * 若沒有輸入則會回傳 true
	 * @param $num_str
	 * @return bool 若沒有輸入則會回傳 true
	 */
	function is_grater_than($input_str, $threshold) {
		if($input_str === '') {
			return true;
		}
		return floatval($input_str) > floatval($threshold);
	}

	/**
	 * 是否大於等於某數
	 * @param $num_str
	 * @return bool
	 */
	function is_grater_than_or_equal_to($input_str, $threshold) {
		// 若相等
		if($this->is_float_equal_to($input_str, $threshold)) {
			return true;
		}
		return $this->is_grater_than($input_str, $threshold);
	}

	/**
	 * 是否小於某數
	 * @param $num_str
	 * @return bool
	 */
	function is_less_than($input_str, $threshold) {
		return floatval($input_str) < floatval($threshold);
	}

	/**
	 * 是否小於等於某數
	 * @param $num_str
	 * @return bool
	 */
	function is_less_than_or_equal_to($input_str, $threshold) {
		// 若相等
		if($this->is_float_equal_to($input_str, $threshold)) {
			return true;
		}
		return $this->is_less_than($input_str, $threshold);
	}
	
	/**
	 * 是否兩個數字轉 float 後為相等？
	 * @param $input_str
	 * @param $comparator
	 * @return bool
	 */
	function is_float_equal_to($input_str, $comparator) {
		// 若兩個 float 值是相同的話
		if(abs(floatval($input_str) - floatval($comparator)) < 0.00000001) {
			return true;
		}
		return false;
	}

	/**
	 * 是否有輸入檔案
	 * @param $input_field_name
	 * @return unknown_type
	 */
	function file_upload_required($field) {
		if(isset($_FILES[$field]['error'])) {
			return $_FILES[$field]['error'] == UPLOAD_ERR_OK;
		}
		return false;
	}


	/**
	 * 是否為合法的圖檔格式
	 * 若沒有上傳檔案則不檢查，回傳 true
	 * @param $str
	 * @param $field
	 * @return bool
	 */
	function is_allowed_image($field) {
		if($this->file_upload_required($field) && isset($_FILES[$field]['name'])) {
			$is_success = preg_match('/\.(png|jpe?g|gif)$/i', $_FILES[$field]['name'], $matches);
			return ($is_success !=0) ;
		}
		return true;
	}

	function valid_file_fiter($field, $fiter) {
		$fiters = explode("|", $fiter);
		$this->set_message("valid_file_fiter", "上傳的副檔名必須是 ".join(", ", $fiters));
		
		if($this->file_upload_required($field) && isset($_FILES[$field]['name'])) {
			$is_success = preg_match("/\.($fiter)$/i", $_FILES[$field]['name'], $matches);
			return ($is_success != 0) ;
		}
		return true;
	}
	
	/**
	 * 檔案大小限制
	 * 若沒有上傳檔案則不檢查，回傳 true
	 * @param $field
	 * @param $allowed_size
	 * @return bool
	 */
	function max_filesize($field, $allowed_size) {
		if($this->file_upload_required($field) && isset($_FILES[$field]['size'])) {
			return ($_FILES[$field]['size'] <= $allowed_size) ;
		}
		return true;
	}

	/**
	 * 指定照片的比例
	 * @param $field
	 * @param $ratio 採取 [4:3]這樣的寫法傳入
	 * @return bool
	 */
	function image_ratio($field, $ratio) {
		// 若沒有上傳檔案，則回傳 true
		//要用 name 來判斷，以防止不是一定得上傳的時候的誤判
		if($_FILES[$field]['name']==='') {
			return true;
		}

		// 若上傳檔案非圖片的話，則回傳 true
		if(!$this->is_allowed_image($field)) {
			return true;
		}

		// 若有上傳檔案且是圖片，則檢查它的長寬

		// 取得想要的比例
		$ratio_arr = explode(':', $ratio);
		$expected_width = floatval($ratio_arr[0]);
		$expected_height = floatval($ratio_arr[1]);
		$expected_ratio = $expected_width/$expected_height;

		// 取得實際的比例
		$size = getimagesize($_FILES[$field]['tmp_name']);
		$real_width = floatval($size[0]);
		$real_height = floatval($size[1]);
		$real_ratio = $real_width/$real_height;
		if(abs($real_ratio - $expected_ratio) < 0.1) {
			return true;
		}
		return false;
	}

	/**
	 * 檢查輸入的內容是否為 16 進位的顏色值
	 * @return bool
	 */
	function check_color_hex_index($str) {
		$pattern = "/^[0-9a-fA-F]{6}$/";
		$result = preg_match($pattern, $str);
		if( $result > 0) {
			return true;
		}
		return false;
	}

	function valid_id($id, $table_name) {
		$sql = "select * from {$table_name} where id = ?";
		$CI = get_instance();
		if($CI->db->query($sql, array($id))->num_rows() == 0) {
			return false;
		}
		return true;
	}

	function valid_primary_column($id, $param) {
		$params = explode(";", $param);
		$sql = "select * from {$params[0]} where {$params[1]} = ?";
		$CI = get_instance();
		if($CI->db->query($sql, array($id))->num_rows() == 0) {
			return false;
		}
		return true;
	}
	
	/**
	 * 數字或是空字串
	 * @param $str
	 * @return bool
	 */
	function numeric_or_empty($str) {
		if($str === '') {
			return true;
		}
		return $this->numeric($str);
	}

	/**
	 * param 格式：「tabaleName;isUpper;assoc_to_segment(array);id」。
	 * 第一個是 table 名稱。
	 * 第二個是「是否使用 UPPER」。
	 * 第三個是要組成 WHERE 條件的欄位與值的 Hash，且必須經過 assoc_to_segment 編碼。
	 * 第四個是該筆資料的 id 值（可以省略，用於編輯時。）
	 * @param unknown_type $input
	 * @param unknown_type $param
	 */
	function vaild_column_unique($input, $param) {
		$this->set_message("vaild_column_unique", "此值已存在，請另行輸入其它值");
		$params = explode(";", $param);

		if ((count($params) == 3) || (count($params) == 4)) {
			$where_clauses = array();
			$where_binds = array();
			
			$data = segment_to_assoc($params[2]);
			
			if (count($params) == 4) {
				$where_clauses []= " id <> ? ";
				$where_binds [] = $params[3];
			}
			
			foreach ($data as $key=>$val) {
				if ('true' === $params[1]) {
					$where_clauses []= " UPPER($key) = UPPER(?) ";
				} else {
					$where_clauses []= " $key = ? ";
				}
				$where_binds [] = $val;
			}
			
			$where_str = '';
			if (count($where_clauses) > 0) {
				$where_str = 'WHERE '.join(' AND ', $where_clauses);
			}
			
			$sql = 'SELECT * FROM '.$params[0].' '.$where_str;
			return get_instance()->db->query($sql, $where_binds)->num_rows() < 1;
		} else {
			$this->set_message("vaild_column_unique", "vaild_column_unique 參數錯誤。");
			return false;
		}
	}
	
	/**
	 * param 格式：「tabaleName;columnName;id」。
	 * 第一個是 table 名稱、
	 * 第二個是 column 的名稱、
	 * 第三個是該筆資料的 id 值（可以省略）
	 * @param $input
	 * @param $param
	 * @return unknown_type
	 */
	function unique($input, $param){
		$this->set_message("unique", "此值已存在，請另行輸入其它值");
		$params = explode(";", $param);
		if(count($params)==3){
			$sql = "SELECT * FROM ".$params[0]." WHERE ".$params[1]." = ? AND id <> ?";
			return get_instance()->db->query($sql, array($input, $params[2]))->num_rows()<1;
		}

		$sql = "SELECT * FROM ".$params[0]." WHERE ".$params[1]." = ?";

		return get_instance()->db->query($sql, array($input))->num_rows()<1;
	}

	function upper_unique($input, $param){
		$this->set_message("upper_unique", "此值已存在，請另行輸入其它值");
		return $this->unique(strtoupper($input), $param);
	}
	
	//XXX 似乎會跟實際時間差一天，要再確認。
	/**
	 * param 格式：「start_data;flag」
	 * 第一個是日期的比較基準
	 * 第二個是是否允許相同，有值表示可以相同（可以省略）
	 * @param $input
	 * @param $param
	 * @return unknown_type
	 */
	function after($input, $param){
		$params = explode(";", $param);
		$start = strtotime($params[0]);
		$end = strtotime($input);

		$this->set_message("after", "日期必須在 ".$params[0]." 之後");
		if(count($params)==2){
			return $start <= $end;
		}

		return $start < $end;
	}
	
	/**
	 * 判斷輸入的數值是否為大於 0 的浮點數且小數點只有一位。
	 * @param $str
	 */
	function is_float_great_than_zero($str) {
		if ( ! preg_match( '/^[0-9]+\\.[0-9]{1}$/', $str))
		{
			return FALSE;
		}
		
		if( $str <= 0) {
			return FALSE;
		}
		
		return TRUE;
	}
	
	/**
	 * 驗證登入的帳號與密碼是否吻合
	 * @param String $account
	 */
	function is_account_and_password_correct($account, $table){
		$this->set_message("is_account_and_password_correct", "帳號密碼不符");
		$sql = "SELECT * FROM ".$table." WHERE UPPER(account) = UPPER(?) AND password = ?";
		return get_instance()->db->query($sql, array(strtoupper($account), md5($_POST['password'])))->num_rows() == 1;
	}

	/**
	 * 驗證身份證格式。
	 * @param $str
	 */
	function valid_identity_code($str) {
		$str = strtoupper($str);
		$pattern = "/^[A-Z][1-2][0-9]{8}$/";
		$result = preg_match($pattern, $str);
		if( $result > 0) {
			$table = array('A'=>10, 'B'=>11, 'C'=>12, 'D'=>13, 'E'=>14, 'F'=>15, 'G'=>16, 'H'=>17, 
						'J'=>18, 'K'=>19, 'L'=>20, 'M'=>21, 'N'=>22, 'P'=>23, 'Q'=>24, 'R'=>25, 
						'S'=>26, 'T'=>27, 'U'=>28, 'V'=>29, 'W'=>30, 'X'=>31, 'Y'=>32, 'Z'=>33, 'I'=>34, 'O'=>35);
			$X = $table[substr($str, 0, 1)];
			$X1 = substr($X, 0, 1);
			$X2 = substr($X, 1, 1);
			$sum = intval($X1) + intval($X2) * 9;
			$j = 8;
			for($i = 1; $i < 9; $i++, $j--) {
				$sum += intval(substr($str, $i, 1)) * $j;
			}
			$result = 10 - $sum % 10;
			if($result == 10) {
				$result = 0;
			}
			return $result === intval(substr($str, 9, 1));
		}
		return false;
	}
	
	function after_date($input, $param) {
		$this->set_message('after_date', '系統出錯，請通知系統管理員！');
		$explode = explode(";", $param);
		if(count($explode) < 4) {
			return FALSE;
		}
		//$explode[4] for array用
		if(isset($explode[4])){
			$this->set_message('after_date', '年月必須在'.$_POST[$explode[2]][$explode[4]].'-'.$_POST[$explode[3]][$explode[4]].'之前！');
			$start = strtotime($_POST[$explode[0]][$explode[4]].'-'.$_POST[$explode[1]][$explode[4]].'-01');
			$end = strtotime($_POST[$explode[2]][$explode[4]].'-'.$_POST[$explode[3]][$explode[4]].'-01');
		} else {
			$this->set_message('after_date', '年月必須在'.$_POST[$explode[2]].'-'.$_POST[$explode[3]].'之前！');
			$start = strtotime($_POST[$explode[0]].'-'.$_POST[$explode[1]].'-01');
			$end = strtotime($_POST[$explode[2]].'-'.$_POST[$explode[3]].'-01');
		}
		return $start < $end;
	}
	
	function max_value($input, $val) {
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}
		return (intval($input) > $val) ? FALSE : TRUE;
	}
	
	function min_value($input, $val) {
		if (preg_match("/[^0-9]/", $val))
		{
			return FALSE;
		}
		return (intval($input) < $val) ? FALSE : TRUE;
	}
	
	function equal_field($input, $field) {
		$this->set_message('equal_field', '密碼確認與密碼不符，請重新輸入！');
		return ($input === $_POST[$field]);
	}
}