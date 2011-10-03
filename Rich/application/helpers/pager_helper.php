<?php
/**
 * 產生 pager 所需要的相關參數。要搭配 application/vies/util/pager.php 服用
 * $location 的範例：foo_controller/foo_action/%s/${query_string}
 * @param $location	這個 pager 要鑲在哪一頁上頭（跟運算沒關係，只是方便 XD）
 * @param $cur_page	目前在第幾頁
 * @param $total_rows	要顯示的資料總共有幾筆
 * @param $rows_per_page	每一頁有幾筆資料
 * @return array ("location"=>pager 所在網頁, "total_rows"=>全部筆數,
 * 			"cur_page"=>目前頁數, "cur_rows"=>目前顯示幾筆, <br>
 * 			"first_page"=>第一頁頁碼, "last_page"=>最後一頁頁碼, <br>
 * 			"prev_page"=>上一頁頁碼, "next_page"=>下一頁頁碼, <br>
 * 			"start_num"=>起始的資料筆數 , "max_page"=>總共頁數)
 */
function pager_param($location, $cur_page, $total_rows, $rows_per_page) {
	$pager_window = 10;	//決定 pager 會顯示幾個數字
	$pre_page_num = intval(floor($pager_window / 2)) - 1;
	$post_page_num = intval(floor($pager_window / 2));

	//將 argument 打包
	$param = array();
	$param["location"] = $location;
	$param["total_rows"] = $total_rows;

	// 算出最大頁數
	$max_page = max(1, ceil($total_rows/$rows_per_page));
	$param['max_page'] = $max_page;

	//修正目前頁數大於最大頁數的問題
	$param['cur_page'] = max(1, min($cur_page, $max_page));

	// 算出起始頁數
	$param['first_page'] = max(1, $param['cur_page'] - $pre_page_num);
	$param['last_page'] = min($max_page, $param['cur_page'] + $post_page_num);

	//此頁的筆數
	$param['cur_rows'] = $rows_per_page;
	if($param['cur_page'] == $max_page) {
		$param['cur_rows'] = $total_rows - ($param['cur_page'] - 1) * $rows_per_page;
	}

	// 算出上一頁
	$param['prev_page'] = max(1, $param['cur_page'] - 1);
	$param['next_page'] = min($max_page, $param['cur_page'] + 1);

	//該頁起始的資料筆數
	$param["start_num"] = $rows_per_page*($param["cur_page"]-1);

	return $param;
}
