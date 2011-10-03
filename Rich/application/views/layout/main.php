<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta content="no-cache" http-equiv="Cache-Control" />
	<meta content="no-cache" http-equiv="Pragma" />
	
	<title>Welcome to CodeIgniter</title>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"/>

	<link rel="stylesheet" type="text/css" href="<?=base_url().DIR_CSS?>reset.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url().DIR_CSS?>style.css" />
</head>

<body>

<div class="header">
	<h1><?php echo nbs(4)?><span><?php echo nbs(4)?></span></h1>
</div>

<table class="main_table" cellpadding="0" cellspacing="0">
	<tr>
		<td style="	background-color: #ecf3fb; width: 300px; vertical-align: top;">
			<?php echo $menu; ?>
		</td>
		<td><?php echo $content; ?></td>
	</tr>
</table>

<div class="footer">
	Copyright &copy; 2011
	Power by Rack Xiao@FB
</div><!-- footer -->

</body>
</html>