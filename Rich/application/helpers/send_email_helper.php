<?php
/**
 * 寄送信件
 * @param	str	$toStr		用,分隔
 * @param	str	$subject	主旨
 * @param	str	$message	內文
 * @param	str	$bccStr		需要另外轉寄的位置
 */
function sendmail($toStr, $subject, $message, $bccStr=''){
	$CI = &get_instance();
	$CI->load->library('PHPMailer');
	
	$mail= new PHPMailer();
	$mail->From = getParam('sendEmail');
	$mail->FromName = getParam('companyName')."【".getParam('sendEmail')."】";
	$mail->Subject = $subject;
	$mail->MsgHTML($message);
	
	//指定收件者的email位址，**並且設定收件者名稱
	$toAry = split(",", $toStr);
	foreach($toAry as $to) {
		$mail->AddAddress($to);
	}

	$bccAry = split(",", $bccStr);
	foreach($bccAry as $bcc) {
		$mail->AddBCC($bcc);
	}
	
	$mail->IsHTML(true);
	//設定信件內容為HTML
	if(!$mail->Send())
	{
		$str = "通知信件寄出失敗";
		$str +="Mailer Error: " . $mail->ErrorInfo;
		return $str;
		exit;
	}
	return "通知信件已寄出";
}

/**
 * 直接給email樣版的名稱，會將內容需要取代掉的地方取代
 * @param	str	$templateName
 * @param	obj	$param
 */
function email_template_replace($templateName, $param){
	$CI = &get_instance();
	$template = $CI->load->view(DIR_EMAIL_TEMPLATE.$templateName, '', true);
	
	foreach($param as $key=>$value){
		$template = str_replace('$var->'.$key, $value, $template);
	}
	
	return $template;
}