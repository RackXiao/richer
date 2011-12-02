
<div class="path" >
	<p class="path_string">
		<span><?php echo M_C_NORMAL ?></span>
		&gt;
		<span class="last_item"><?php echo M_CONTENT ?></span>
	</p>
</div>

<?php echo form_open('content_management/dispatch')?>
<!-- <input type="hidden" name="page_num" value="<?php //echo $page_num ?>" /> -->
<!-- <input type="hidden" name="query_string" value="<?php //echo $query_string ?>" /> -->
<input type="button" value="New" onclick="add_btn()" />
<fieldset id="add_field">
	<legend> 新增 </legend>
	<p>標題：<span class="subject"><input type="text" name="subject" /></span></p>
	<p>內容：<span class="content"><textarea name="content"></textarea></span></p>
	<p><input type="button" value="New" onclick="add_a_row()" /></p>
</fieldset>
<?php foreach($content as $row): ?>
<fieldset id="row<?php echo $row->id ?>">
	<legend> 標題：<span class="subject"><?php echo $row->subject ?></span> </legend>
	<div align="right"><?php echo date('Y-m-d H:i',strtotime($row->createTime)) ?></div>
	<p>
		<span class="content"><?php echo $row->content ?></span>
	</p>
	<div align="right">
		<input type="button" value="EDIT" onclick="edit_row(<?php echo $row->id ?>)" />
		<input type="button" value="X" onclick="del_row(<?php echo $row->id ?>)" />
	</div>
</fieldset>
<?php endforeach; ?>
<?php echo form_close()?>
<?php //echo $pager_str; ?>

<script>
$(function(){
	$('#add_field').hide();
});

function add_btn(){
	$isShow = $('#add_field').is(":visible");
	if($isShow) { 
		$('#add_field').hide();
	} else {
		$('#add_field').show();
	}
}

function add_a_row(){
	var data = new Object();
	data.subject = $('input[name=subject]').val();
	data.content = $('textarea[name=content]').val();
	save_row(data);
}

function save_row(data){
	$.ajax({
		url: "<?php echo uri_string() ?>/ajax_save",
		type: "POST",
		data: data,
		dataType: "json",
		success: function(){
			if(data.id==null){
				location.href = '<?php echo site_url(uri_string()) ?>';
			}
		}
	});
}

function edit_row(id){
	if($('#row'+id).attr('class')==''){
		$('#row'+id).addClass('editing');
		asForm(id);
	}else{
		$('#row'+id).removeClass('editing');
		asView(id);
	}
}

function asForm(id){
	value = $('#row'+id+' .subject').html();
	$('#row'+id+' .subject').html($('#add_field .subject').html());
	$('#row'+id+' input[name=subject]').val(value);

	value = $('#row'+id+' .content').html();
	$('#row'+id+' .content').html($('#add_field .content').html());
	$('#row'+id+' textarea[name=content]').val(value);
}

function asView(id){
	var data = new Object();
	data.id = id;
	data.subject = $('#row'+id+' input[name=subject]').val();
	data.content = $('#row'+id+' textarea[name=content]').val();
	save_row(data);
	$('#row'+id+' .subject').html(data.subject);
	$('#row'+id+' .content').html(data.content);
}

function del_row(id){
	if(confirm('確定刪除？')){
		$.ajax({
			url: "<?php echo uri_string() ?>/ajax_remove/"+id,
			success: function(){
				$('#row'+id).hide();
			}
		});
	}
}
</script>