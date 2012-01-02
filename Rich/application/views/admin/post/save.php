<?php echo form_open_multipart(uri_string()) ?>
<input type="hidden" name="id" value="<?php echo isset($item)?$item->id:'' ?>" />

<table cellspacing="0" cellpadding="0" class="new"> 
	<tr> 
		<th>標題</th> 
		<td> 
			<input type="text" class="textbox" name="subject" value="<?php echo set_value('subject', isset($item)?$item->subject:''); ?>"/>
			<?php echo form_error('subject', ERR_MSG_PREFIX, ERR_MSG_SUFFIX);?>
		</td> 
	</tr>
	<tr> 
		<th>說明</th> 
		<td> 
			<textarea name="content" class="textbox editor"><?php echo set_value('content', isset($item)?$item->content:''); ?></textarea>
			<?php echo form_error('content', ERR_MSG_PREFIX, ERR_MSG_SUFFIX);?>
		</td> 
	</tr>
</table>
<div class="submit_box"> 
	<input type="submit" value="送出" /> 
	<input type="button" value="取消" onclick="window.location='<?php echo site_url("{$controller}/index/{$page_num}/{$query_string}"); ?>';" />
</div> 
<?php echo form_close() ?>