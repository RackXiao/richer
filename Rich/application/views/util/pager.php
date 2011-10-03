<!-- Pager Block @ view/util/pager.php -->
<div class="pager horizontal_list">
	<ul>
		<li><?php echo anchor(sprintf($location, 1), "First", 'class="page_first"'); ?></li>
		<li><?php echo anchor(sprintf($location, $prev_page), "Prev", 'class="page_prev"'); ?></li>
		<?php 
			for($i = $first_page; $i<= $last_page; $i++) {
				if($i == $cur_page) {
					echo '<li><span class="page_current">'.$i.'</span></li> ';
				} else {
		  			echo "<li>".anchor(sprintf($location, $i), $i, 'class="page"')."</li> ";
				}
			}
		?> 
		<li><?php echo anchor(sprintf($location, $next_page), "Next", 'class="page_next"'); ?></li>
		<li><?php echo anchor(sprintf($location, $max_page), "Last", 'class="page_last"'); ?></li>
	</ul>
	<div class="clear_b"></div>
</div>
<div class="record_box"><span class="page_current">第 <?php echo $cur_page; ?> 頁</span> /<span class="record_total"> 共 <?php echo $total_rows; ?> 筆資料</span></div>
<!-- Pager Block end-->