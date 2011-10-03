
<div class="navigator" ><div class="navigator_title">系統管理</div>
<?php //if($this->session->userdata('isAdminLogin') == 1) {?>
<h3>主站管理</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/photo_slideshow");?>"><span>主站照片輪播管理</span><span class="hint">（主站照片輪播管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/article");?>"><span>文章管理</span><span class="hint">（主站文章管理）</span></a>
	</li>
</ul>
<h3>圖片管理</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/image_type");?>"><span>圖片類型管理</span><span class="hint">（圖片類型管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/image");?>"><span>圖片管理</span><span class="hint">（圖片管理）</span></a>
	</li>
</ul>
<h3>子站管理</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_info");?>"><span>子站資訊</span><span class="hint">（子站資訊）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_photo_slideshow");?>"><span>子站照片輪播</span><span class="hint">（子站照片輪播）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_ad");?>"><span>廣告管理</span><span class="hint">（廣告管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_quick_menu");?>"><span>快速選單管理</span><span class="hint">（快速選單管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_travel_help");?>"><span>當地旅遊說明管理</span><span class="hint">（當地旅遊說明管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_attractions_category");?>"><span>景點類別管理</span><span class="hint">（景點類別管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_attractions");?>"><span>景點管理</span><span class="hint">（景點管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_hotel_rate");?>"><span>飯店等級管理</span><span class="hint">（飯店等級管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_hotel");?>"><span>飯店管理</span><span class="hint">（飯店管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_fit_travel_category");?>"><span>自由行類型管理</span><span class="hint">（自由行類型管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_fit_travel");?>"><span>自由行管理</span><span class="hint">（自由行管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/group_type");?>"><span>團型管理</span><span class="hint">（團型管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/group_outgo");?>"><span>出團管理</span><span class="hint">（出團管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_url");?>"><span>連結管理</span><span class="hint">（連結管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/sub_site_doc");?>"><span>文件管理</span><span class="hint">（文件管理）</span></a>
	</li>
</ul>
<h3>會員管理</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/general_member");?>"><span>一般會員管理</span><span class="hint">（一般會員管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/industry_member");?>"><span>同業會員管理</span><span class="hint">（同業會員管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/member_terms");?>"><span>會員條款設定</span><span class="hint">（會員條款設定）</span></a>
	</li>
</ul>
<h3>表單管理</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/form_enterprise");?>"><span>企業旅遊需求單</span><span class="hint">（企業旅遊需求單）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/form_group");?>"><span>團體報名單</span><span class="hint">（團體報名單）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/form_fit");?>"><span>自由行訂單</span><span class="hint">（自由行訂單）</span></a>
	</li>
</ul>
<h3>電子報群組</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/email");?>"><span>電子報名單下載</span><span class="hint">（電子報名單下載）</span></a>
	</li>
</ul>
<h3>系統管理</h3>
<ul>
	<li>
		<a href="<?php echo site_url("admin/system_info/index/");?>"><span>系統參數管理</span><span class="hint">（系統參數管理）</span></a>
	</li>
</ul>
<ul>
	<li>
		<a href="<?php echo site_url("admin/email_template/index/");?>"><span>信件樣板管理</span><span class="hint">（信件樣板管理）</span></a>
	</li>
</ul>
<h3>其他</h3>
<?php if(CURRENT_MODE != PRODUCTION):?>
<ul>
	<li>
		<a href="<?php echo site_url("admin/database_management/index/");?>"><span>資料庫管理</span><span class="hint">（資料庫管理）</span></a>
	</li>
</ul>
<?php endif;?>
<ul>
	<li>
		<a href="<?php echo site_url("admin/pw_change/");?>">變更密碼</a>
	</li>
</ul>
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
