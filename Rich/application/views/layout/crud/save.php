<!-- <div class="path" >
<p class="path_string">
<span><?php echo $group_name ?></span>
		&gt;
		<span class="last_item"><?php echo $manage_name ?></span>
	</p>
</div> -->

<div id="content2">
	<input type="button" value="回<?php echo $manage_name ?>管理" onclick="window.location='<?php echo site_url("{$controller}/index/{$page_num}/{$query_string}")?>';" /> 
	
	<?php echo $sub_content ?>
</div>