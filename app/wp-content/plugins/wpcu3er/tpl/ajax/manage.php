<?php
# cannot call this file directly
?>
<div class="wrap">
	<?php echo $js; ?>
	<script type="text/javascript">
		var previewWidth, previewHeight;
		var url = null;
		var title = "CU3ER";
		var options = '';
		var left = 0;
		var top = 0;
		
		jQuery(document).ready(function($) {
			$('.mbpc_preview').bind('click', function() {
				var href = url = $(this).attr('href');
				if(tbWidth = href.match(/&width=[0-9]+/)) {
					tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10) + 20;
				} else {
					tbWidth = $(window).width() - 90;
				}

				if(tbHeight = href.match(/&height=[0-9]+/)) {
					tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10) + 50;
				} else {
					tbHeight = $(window).height() - 60;
				}
				showPreview(href, tbWidth, tbHeight);
				return false;
			});
		});

		function showPreview(urlPreview, width, height) {
			previewWidth = width;
			previewHeight = height;

			left = (window.screen.width - previewWidth) / 2;
			top = (window.screen.height - previewHeight) / 2;

			url = urlPreview;
			options = 'toolbar=0,locationbar=0,status=0,width='+width+',height='+height+',top='+top+',left='+left;
			showPreviewUrl();
		}

		function showPreviewUrl() {
			window.open(url, title, options);
		}

	</script>
	
	<br class="clear"/>
	
	<h2>Insert CU3ER</h2>
		
	<?php if(sizeof($slideshows)): ?>		
			
		<table class="widefat">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col" width="30%">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($slideshows as $slideshow): ?>
				<tr class="alternate author-self status-publish" valign="top">
					<td><?php echo $slideshow['id']; ?></td>
					<td><?php echo $slideshow['name']; ?></td>
					<td id="<?php echo $slideshow['id'];?>">
						<a href="#" class="mdpc_select" title="Select slideshow" rel="<?php echo $slideshow['id']; ?>">Insert</a>&nbsp;|&nbsp;
						<a href="admin.php?page=CU3ERManageAll&id=<?php echo $slideshow['id']; ?>" class="mdpc_manage" title="Edit slideshow">Edit</a>&nbsp;|&nbsp;
						<a href="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&id=<?php echo $slideshow['id']; ?>&TB_iframe=true&width=<?php echo $slideshow['width']; ?>&height=<?php echo $slideshow['height']; ?>" class="mbpc_preview" title="Preview">Preview</a>
					</td>	
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
	
	<br class="clear"/> 
</div>
