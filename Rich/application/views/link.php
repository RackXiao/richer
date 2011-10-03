
<div class="path" >
	<p class="path_string">
		<span>子站管理‎</span>
		&gt;
		<span class="last_item">廣告管理</span>
	</p>
</div>

<?php echo form_open('admin/sub_site_ad/dispatch')?>

<input type="hidden" name="page_num" value="<?php //echo $page_num ?>" />
<input type="hidden" name="query_string" value="<?php //echo $query_string ?>" />
<input type="submit" value="New" name="new_btn" class="submit"/>
<input type="submit" value="Delete" name="delete_btn" class="submit"/>
<fieldset>
	<legend> 搜 尋 </legend>
	<p>
		所屬子站：
		<?php 
//			$default_value = isset($conditions["search"]["SubSiteInfo_id"])?$conditions["search"]["SubSiteInfo_id"]:SELECT_DontCare;
//			$hash = array(array('id'=>SELECT_DontCare, 'title'=>SELECT_DontCare));
//			echo select_tag($all_sub_site_info, 'id', 'title', 'search[SubSiteInfo_id]', $default_value, $hash, '');
		?>
	</p>
	<input type="submit" value="搜尋" name="search_btn" class="submit"/>
</fieldset>
<table class="list_table">
	<tr class="table_head">
		<th></th>
		<th>編號</th>
		<th>所屬子站</th>
		<th>標題</th>
		<th>連結</th>
		<th>廣告圖片</th>
		<th>操作</th>
	</tr>
	<?php /*foreach($sub_site_ad_list as $sub_site_ad): ?>
		<tr>
			<td><input type="checkbox" name="sub_site_ad_list[]" value="<?php echo $sub_site_ad->id; ?>" /></td>
			<td><?php echo anchor('admin/sub_site_ad/editProcess/'.$sub_site_ad->id.'/'.$page_num.'/'.$query_string, $sub_site_ad->id); ?></td>
			<td><?php echo !empty($sub_site_info_array[$sub_site_ad->SubSiteInfo_id]) ? html_to_text($sub_site_info_array[$sub_site_ad->SubSiteInfo_id]):NO_SUBSITE; ?></td>
			<td><?php echo html_to_text($sub_site_ad->title); ?></td>
			<td><?php echo html_to_text($sub_site_ad->url); ?></td>
			<td><?php if(!empty($sub_site_ad->image)):?><img class="thumbnail" src="<?php echo base_url().UPLOAD_URI_PATH.$sub_site_ad->image; ?>"><?php endif;?></td>
			<td>
				<input type="submit" value="<?php echo QUICK_MENU_UP_BTN_VALUE; ?>" name="change_arrange_btn[<?php echo $sub_site_ad->id; ?>]" class="submit"/>
				<input type="submit" value="<?php echo QUICK_MENU_DOWN_BTN_VALUE; ?>" name="change_arrange_btn[<?php echo $sub_site_ad->id; ?>]" class="submit"/>
			</td>
		</tr>
	<?php endforeach;*/ ?>
</table>
<?php echo form_close()?>
<?php //echo $pager_str; ?>
