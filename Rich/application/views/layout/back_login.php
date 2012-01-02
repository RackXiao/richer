<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta content="no-cache" http-equiv="Cache-Control" />
<meta content="no-cache" http-equiv="Pragma" />

<link rel="stylesheet" href="<?php echo base_url();?>css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" /> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>

<title>D.</title>

</head>
<body>
<div id="wrap">
	<div id="wrap2">
		<div id="main">
			<div id="header" > 
				<p class="title">D.</p> 
			</div> 
			<div id="content" class="left">
				<div id="content2" >
					<h2>D.</h2>
					<?php echo form_open('admin/login/index', 'id="contact_form" style="margin: 0pt; padding: 0pt;"') ?>
					    <table cellspacing="0" cellpadding="0" class="table-login table-form">
					        <tbody>
					            <tr>
					                <th>帳號</th>
					                <td>
					                	<input type="text" name="account" class="textbox" value="<?php echo set_value('account', ''); ?>" />
										<?php echo form_error('account', ERR_MSG_PREFIX, ERR_MSG_PREFIX);?>
					                	
					                </td>
					            </tr>
					            <tr>
					                <th>密碼</th>
					                <td>
					                	<input type="password" name="password" class="textbox" value="<?php echo set_value('password', ''); ?>"/>
										<?php echo form_error('password', ERR_MSG_PREFIX, ERR_MSG_PREFIX);?>
					                	
					                </td>
					            </tr>
					            <tr>
					            	<th></th>
					                <td>
					                	<input type="submit" value="登入"/>
					                </td>
					            </tr>
					        </tbody>
					    </table>
					<?php echo form_close() ?>
				</div>
			</div>
			<div class="clear_b"></div>
		</div>
		<div class="wrap2_closer"></div>
	</div>	
	<div class="clear_b wrap_closer"></div>
</div>

<div class="footer">
	Copyright &copy; 2011
	Power by Rack Xiao@FB
</div><!-- footer -->
	
<script>
$(function() {
	$( "input:submit,input:button,input:reset " ).button();
});

<?php if(is_array($this->session->userdata("alert_messages"))):?>
<?php foreach($this->session->userdata("alert_messages") as $message):?>
alert('<?php echo $message;?>');
<?php endforeach;?>
<?php $this->session->unset_userdata('alert_messages');?>
<?php endif;?>
</script>
</body>
</html>