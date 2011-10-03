<?php

/**
 * 
 * 計算兩個日期相差幾年幾月。
 * @param $start		起始時間。
 * @param $end			結束時間。
 * @return	array		回傳 arra(year, month)。
 */
function date_diff_year_and_month($start, $end) {
	if(empty($start) || empty($end)) {
		return array(0, 0);
	}
	
	$datediff = strtotime($end) - strtotime($start);
	$year = floor($datediff/(3600*24*365));
	$month = floor(($datediff % (3600*24*365))/(3600*24*(365/12)));
	return array($year, $month);
}

/**
 * 將輸入的日期依照所輸入的運算元，做加法運算，結果會回傳包含年月日以及完整日期的 array。
 * @param $date				所要運算的日期。
 * @param $monthOperand		月的運算元。
 * @param $dayOperand		日的運算元。
 * @param $yearOperand		年的運算元。
 * @return	array		回傳 arra('year'=>計算後所得的年份, 'month'=>計算後所得的月份, 'day'=>計算後所得的日期, 'date'=>計算厚的完整日期)。
 */
function date_computing($date, $monthOperand, $dayOperand, $yearOperand) {
	$time = strtotime($date);
	$day = date('d', $time);
	$month = date('m', $time);
	$year = date('Y', $time);
	$result = date("Y-m-d", mktime(0, 0, 0, $month + $monthOperand, $day + $dayOperand, $year + $yearOperand));
	$resultTime = strtotime($result);
	
	return array('year'=>date('Y', $resultTime), 'month'=>date('m', $resultTime), 'day'=>date('d', $resultTime), 'date'=>$result);
}