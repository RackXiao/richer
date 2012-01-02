<div class="horizontal_list admin_menu"> 
	<ul> 
	   	<li>
	   		<input type="submit" value="新增" name="new_btn" />
	    	<input type="submit" value="刪除" name="delete_btn" onclick="return isSelected()" />
	    	<input type="submit" value="啟用" name="enable_btn" onclick="return isSelected();" />
			<input type="submit" value="關閉" name="disable_btn" onclick="return isSelected();" />
		    </li>  
		</ul> 
    </div>
		<div class="clear_b"></div> 
	
	<div class="member"> 
		<table cellspacing="0" cellpadding="0" class="table-members table-admin table-vertical"> 
			<tr>
				<th></th>
				<th></th>
				<th>標題</th>
				<th>內容</th>
				<th>是否啟用</th>
			</tr>
		<?php foreach($list as $item): ?>
		<tr <?php if (end($list)->id == $item->id) echo 'class="bottom"' ?>>
			<td><input type="checkbox" name="id_list[]" value="<?php echo $item->id ?>" /></td>
			<td><input type="button" value="編輯" onclick="location='<?php echo site_url("{$controller}/editProcess/{$item->id}/{$page_num}/{$query_string}") ?>'"/></td>
			<td><?php echo $item->subject ?></td>
			<td><?php echo abstract_text(html_to_text($item->content), ABS_STR_LENGTH) ?></td>
			<td><?php echo $item->enable ? '是':'否' ?></td> 
		</tr>
		<?php endforeach ?>
	</table> 
	<?php echo $pager_str ?>
</div> 
