
<div class="navigator" ><div class="navigator_title">管理</div>
<?php //if($this->session->userdata('isAdminLogin') == 1) {?>
<h3><?php echo M_C_NORMAL ?></h3>
<ul>
	<li>
		<a href="<?php echo site_url("welcome");?>">
			<span><?php echo M_INDEX ?></span>
		</a>
	</li>
	<li>
		<a href="<?php echo site_url("content_management");?>">
			<span><?php echo M_CONTENT ?></span><span class="hint">（<?php echo M_CONTENT ?>）</span>
		</a>
	</li>
	<!-- 
	<li>
		<a href="<?php echo site_url("admin/photo_slideshow");?>">
			<span>照片輪播</span><span class="hint">（照片輪播）</span>
		</a>
	</li>
	<li>
		<a href="<?php echo site_url("admin/article");?>">
			<span>文章</span><span class="hint">（主站文章）</span>
		</a>
	</li>
	 -->
</ul>
<h3>設定</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/pw_change/");?>">變更密碼</a>
	</li>
</ul>
<h3>其他</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/logout/");?>">登出</a>
	</li>
</ul>
<?php //} else {?>
<h3>登入</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/login/");?>">登入</a>
	</li>
</ul>
<?php //}?>
</div>
