<?php
# cannot call this file directly
if ( strpos( basename( $_SERVER['PHP_SELF']) , __FILE__ ) !== false ) exit;
include_once('header.php');
?>
<div class="wrap wrap-CU3ER">
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var menus = $("#toplevel_page_CU3ER .wp-submenu ul li");
			$(menus).removeClass('current');
			$("a", $(menus)).removeClass('current');
			$(menus[2]).addClass('current');
			$("a", menus[2]).addClass('current');
		});
	</script>
	
	<?php if(sizeof($slideshows)): ?>	
	
	<div class="icon32" id="icon-themes"><br></div>
	<h2>Manage CU3ER sliders <a class="button add-new-h2" href="admin.php?page=CU3ERAddNew">Add new</a></h2>
	<?php include_once('warnings.php'); ?>
	
	<p>From this page you can manage all created CU3ER sliders.</p>	
	
	
		<table class="widefat">
			<thead>
				<tr>
					<th scope="col" width="10%">ID</th>
					<th scope="col" width="40%">Name</th>
					<th scope="col" width="30%">Action</th>
					<th scope="col" width="20%">Modified date/time</th>
					
				</tr>
			</thead>
			<tbody>
			<?php foreach($slideshows as $slideshow): ?>
				<tr class="alternate author-self status-publish" valign="top">
					<td><?php echo $slideshow['id']; ?></td>
					<td><?php echo $slideshow['name']; ?><?php if(!cu3er__isFallback($slideshow['baseUrl'] . '/fallback/')): ?> (<a href="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=old_import_info&TB_iframe=true&width=450&height=250" class="mbpc_preview"><img src="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/img/question.png" /></a> - old import detected, no JavaScript fallback available)<?php endif; ?></td>				
					<td id="<?php echo $slideshow['id'];?>">
						<a href="admin.php?page=CU3ERManageAll&id=<?php echo $slideshow['id']; ?>" class="mdpc_manage" title="Edit">Edit</a> | 
						<a href="admin.php?page=CU3ERManageAll&id=<?php echo $slideshow['id']; ?>&duplicate=true" class="mdpc_manage" title="Edit slideshow">Duplicate</a> | 
						<a href="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&id=<?php echo $slideshow['id']; ?>&TB_iframe=true&width=<?php echo $slideshow['width']; ?>&height=<?php echo $slideshow['height']; ?>" class="mbpc_preview" title="Preview">Preview</a>
						<?php if(cu3er__isFallback($slideshow['baseUrl'] . '/fallback/')): ?> - 
						<a href="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&force_js=true&id=<?php echo $slideshow['id']; ?>&TB_iframe=true&width=<?php echo $slideshow['width']; ?>&height=<?php echo $slideshow['height']; ?>" class="mbpc_preview" title="Preview JavaScript">JS</a><?php endif; ?> | 
						<a href="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=deleteProject&id=<?php echo $slideshow['id']; ?>" class="deleteProject" title="Delete">Delete</a>
					</td>
					<td><?php echo date('Y/m/d \\a\\t g:ia', strtotime($slideshow['modified'])); ?></td>	
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="icon32" id="icon-themes"><br></div>
		<h2>Manage CU3ER sliders</h2>
		<p><strong>You have not created any CU3ER yet.</strong></p>
		 <p><a class="button add-new-h2" href="admin.php?page=CU3ERAddNew">Create your first CU3ER project.</a></p>
	<?php endif; ?>
	
	<br class="clear"/> 
</div>
