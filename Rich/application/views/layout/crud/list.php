<!-- <div class="path" >
	<p class="path_string">
		<span><?php echo $group_name ?></span>
		&gt;
		<span class="last_item"><?php echo $manage_name ?></span>
	</p>
</div> -->

<script src="<?php echo base_url() ?>js/form/list.js"></script>

<div id="content2"> 
<?php echo form_open("{$controller}/dispatch") ?>
<input type="hidden" name="page_num" value="<?php echo $page_num; ?>" />
<input type="hidden" name="query_string" value="<?php echo $query_string; ?>" />

	<h2 style="margin:5px 0;"><?php echo $manage_name ?>管理</h2>
	<?php echo $sub_content ?>
	
<?php echo form_close() ?>
</div>
