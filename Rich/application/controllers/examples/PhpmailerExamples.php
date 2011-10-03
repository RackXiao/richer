<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhpmailerExamples extends CI_Controller {

	/**
	 * 用 phpmailer 從 localhost 的 smtp 寄信
	 */
	public function testMailerForGmail() {
		$this->load->library('PHPMailer');
		$mail= new PHPMailer();
		$mail->IsSMTP(); // set mailer to use SMTP
		$mail->CharSet = 'utf-8';
		$mail->Encoding = 'base64';
		$mail->From = 'qy@qyoung.com.tw';
		$mail->FromName ='qy';
		$mail->Host ="ssl://smtp.gmail.com";
		$mail->Port = 465; //default is 25, gmail is 465 or 587
		$mail->SMTPAuth = true;
		$mail->Username = "qy@qyoung.com.tw";
		$mail->Password = "ex!#%aq";
		$mail->AddAddress("jason@qyoung.com.tw");
		$mail->WordWrap = 50;
		if (!empty($attach))
		
		$mail->IsHTML(true);
		$mail->Subject = "test";
		$mail->MsgHTML("<h2>hi</h2><p>this is a test</p>");
		
		
		if(!$mail->Send())
		{
			echo "通知信件寄出失敗";
			echo "Mailer Error: " . $mail->ErrorInfo;
			exit;
		}
		echo "通知信件已寄出";
	}
	
	/**
	 * 用一般的 SMTP 寄信時用以下的方式寄
	 */
	public function testMailerForLocalhost() {
		$this->load->library('PHPMailer');
		$mail= new PHPMailer();
		$mail->From = 'qy@qyoung.com.tw';
		$mail->FromName ='qy';
		$mail->Subject = "test";
		$mail->MsgHTML("<p>this is a test</p>");
		$mail->AddAddress("jason@qyoung.com.tw");     
		//指定收件者的email位址，並且設定收件者名稱
		$mail->IsHTML(true);
		//設定信件內容為HTML
		if(!$mail->Send())
		{
			echo "通知信件寄出失敗";
			echo "Mailer Error: " . $mail->ErrorInfo;
			exit;
		}
		echo "通知信件已寄出";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */