<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta content="no-cache" http-equiv="Cache-Control" />
<meta content="no-cache" http-equiv="Pragma" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"/>

<script src="<?php echo base_url() ?>js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>js/ckeditor/adapters/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css" />

<title>D.</title>
	
</head>

<body>
<div id="wrap">
	<div id="wrap2">
		<div id="main">
			<div id="header" > 
				<p class="user right">Hi, <?php echo $this->session->userdata('account') ?> 您好  <a href="<?php echo site_url("admin/logout");?>" >登出 </a> </p>
				<p class="title"><?php echo nbs(4)?></p> 
			</div> 
			
			<?php echo $this->load->view('layout/back_memu') ?>

			<div id="content" class="left">
				<?php echo $content; ?>
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
$(function(){
	$( "input:submit,input:button,input:reset " ).button();
	
	$('textarea.editor').ckeditor(
		{
			fullPage : false,
			//filebrowserImageBrowseUrl : "<?php echo base_url().'util/webservice_ajax/index'; ?>",
			entities : false
		}
	);
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