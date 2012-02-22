<?php
# cannot call this file directly
if ( strpos( basename( $_SERVER['PHP_SELF']) , __FILE__ ) !== false ) exit;
include_once('header.php');
?>
<div class="wrap wrap-CU3ER">
	<div id='colorPicker'></div>
	<script type="text/javascript">
		window.onbeforeunload = confirmExit;
		function confirmExit() {
			return "Any unsaved changes will be lost.";
		}
	</script>
	<div class="wrap">
	<div class="icon32" id="icon-options-general"><br></div>
	<h2>Edit &quot;<?php echo $slideshow['name']; ?>&quot; CU3ER
		
			<input type="button" class="button previewButton add-new-h2" value="Preview" name="browse" rel="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&id=<?php echo $slideshow['id']; ?>&TB_iframe=true" />
			<?php if(cu3er__isFallback($baseUrl . '/fallback/')): ?>
			<input type="button" class="button previewButton add-new-h2" value="Preview JS" name="browse" rel="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&force_js=true&id=<?php echo $slideshow['id']; ?>&TB_iframe=true" />
			<?php endif; ?>
			 <span class="loading"></span>
	</h2>
	
	<?php include_once('warnings.php'); ?>	
	
	<div id="edit-slug-box">
		<div class="inputs">
			<strong>XML Location:</strong>
			<span id="sample-permalink"><?php echo $slideshow['xml_location']; ?></span> 
			<a href="#" class="button updateXML">Update</a>
		</div>
		<div class="inputs formXML">
			<form name="changeXML" action="admin.php?page=CU3ERManageAll&id=<?php echo $_GET['id']; ?>&type=xml" enctype="multipart/form-data" method="post">
				<input type="hidden" name="MAX_FILE_SIZE" value="512000000" /> 
				<strong>Update XML:</strong> <input type="file" name="newXML" /> 
				<input type="submit" value="Upload" name="submit" class="button"/>
			</form>
		</div>
	</div>
	<form name="customSettings" id="customSettings" class="customSettings" method="post" action="admin.php?page=CU3ERManageAll&id=<?php echo $_GET['id']; ?>">
	<div class="block">
		<div class="block-head">
			<div class="block-toggle close-btn"></div>
			<h4>General settings</h4> <span> Name, size, background, folder paths & alternative content</span>
		</div>
		<div class="block-inner">
			<div class="transHalf noBorder">
				<input type="hidden" name="settings[id]" id="slideshow_id" value="<?php echo $_GET['id']; ?>" />
				<div class="inputs">
					<label for="name">Name:</label> <input type="text" name="settings[name]" id="name" value="<?php echo $slideshow['name']; ?>" />
				</div>
				<div class="inputs">
					<label for="name">ID:</label> <span style="display:block; margin-top:3px;"><?php echo $slideshow['id']; ?></span>
				</div>
				<h4><span>SWF Size</span></h4>
				<div class="inputs">
					<label for="width">Width:</label> <input type="text" name="settings[width]" id="width" size="7" value="<?php echo $slideshow['width'] ?>" />
				</div>
				<div class="inputs">
					<label for="height">Height:</label> <input type="text" name="settings[height]" id="height" size="7" value="<?php echo $slideshow['height'] ?>" />
				</div>
				
				<h4><span>Folder Locations</span></h4>
				<div class="inputs">
					<label for="images_folder">Images folder:</label> <input type="text" name="settings[images_folder]" id="images_folder" value="<?php echo $slideshow['images_folder'] ?>" />
				</div>
				<div class="inputs">
					<label for="fonts_folder">Fonts folder:</label> <input type="text" name="settings[fonts_folder]" id="fonts_folder" value="<?php echo $slideshow['fonts_folder'] ?>" />
				</div>
			
				<h4><span>Background</span></h4>
				<div class="radios">
					<input type="radio" name="settings[backgroundType]" value="transparent"<?php echo ($slideshow['backgroundType'] == 'transparent') ? ' checked="checked"' : ''; ?> /> <span>Transparent </span>
					<input type="radio" name="settings[backgroundType]"<?php echo ($slideshow['backgroundType'] != 'transparent') ? ' checked="checked"' : ''; ?> value="color" /> Color <input type="text" name="settings[background]" class="color" id="settingsColor" size="7" value="<?php echo ($slideshow['background'] == '' && $slideshow['backgroundType'] != 'transparent') ? '#ffffff' : str_replace('0x', '#', $slideshow['background']); ?>" />
				</div>
				<?php if($slideshow['bg_use_image'] == 'true' && $slideshow['bg_image'] != ''): ?>
				<div class="inputs slide" style="margin-top: 5px;">
					<span class="imageHolder">
						<?php 
							if(cu3er__isImage($slideshow['images_folder'] . '/' . $slideshow['bg_image'])) {
								$image = $slideshow['images_folder'] . '/' . $slideshow['bg_image']; 
							} elseif(cu3er__isHttpPath($slideshow['bg_image'])) {
								if(cu3er__isImage($slideshow['bg_image'])) {
									$image = $slideshow['bg_image'];
								} else {
									$image = $defaultImage;
								}
							} else {
								$image = $defaultImage;
							}
							$imgSize = getimagesize($image);
							$size = ($imgSize['width'] < $imgSize['height']) ? 'height="80"' : 'width="80"';
						?>
						<img src="<?php echo $image; ?>" <?php echo $size; ?> />
						<?php unset($image); ?>
					</span>
					<div class="imageUrl">
						<label for="bg_image">Image URL:</label> <input type="text" class="imageField" name="settings[bg_image]" id="bg_image" value="<?php echo $slideshow['bg_image'] ?>" /> <input type="button" class="button upload_image_button" value="CHANGE" name="browse" />
					</div>
				</div>
				<?php endif; ?>
				<?php if($slideshow['sdw_use_image'] == 'true' && $slideshow['sdw_image'] != '' && $slideshow['sdw_show'] == 'true'): ?>
					<h4><span>Shadow Image</span></h4>
					<div class="inputs slide">
						<span class="imageHolder">
							<?php 
								if(cu3er__isImage($slideshow['images_folder'] . '/' . $slideshow['sdw_image'])) {
									$image = $slideshow['images_folder'] . '/' . $slideshow['sdw_image']; 
								} elseif(cu3er__isHttpPath($slideshow['sdw_image'])) {
									if(cu3er__isImage($slideshow['sdw_image'])) {
										$image = $slideshow['sdw_image'];
									} else {
										$image = $defaultImage;
									}
								} else {
									$image = $defaultImage;
								}
								$imgSize = getimagesize($image);
								$size = ($imgSize['width'] < $imgSize['height']) ? 'height="80"' : 'width="80"';
							?>
							<img src="<?php echo $image; ?>" <?php echo $size; ?> />
							<?php unset($image); ?>
						</span>
						<div class="imageUrl">
							<label for="sdw_image">Image URL:</label> <input type="text" class="imageField" name="settings[sdw_image]" id="sdw_image" value="<?php echo $slideshow['sdw_image'] ?>" /> <input type="button" class="button upload_image_button" value="CHANGE" name="browse" />
						</div>
					</div>
				<?php endif; ?>
				
				<?php if($slideshow['pr_image'] != ''): ?>
					<h4><span>Custom Preloader Image</span></h4>
					<div class="inputs slide">
						<span class="imageHolder">
							<?php 
								if(cu3er__isImage($slideshow['images_folder'] . '/' . $slideshow['pr_image'])) {
									$image = $slideshow['images_folder'] . '/' . $slideshow['pr_image']; 
								} elseif(cu3er__isHttpPath($slideshow['pr_image'])) {
									if(cu3er__isImage($slideshow['pr_image'])) {
										$image = $slideshow['pr_image'];
									} else {
										$image = $defaultImage;
									}
								} else {
									$image = $defaultImage;
								}
								$imgSize = getimagesize($image);
								$size = ($imgSize['width'] < $imgSize['height']) ? 'height="80"' : 'width="80"';
							?>
							<img src="<?php echo $image; ?>" <?php echo $size; ?> />
							<?php unset($image); ?>
						</span>
						<div class="imageUrl">
							<label for="pr_image">Image URL:</label> <input type="text" class="imageField" name="settings[pr_image]" id="pr_image" value="<?php echo $slideshow['pr_image'] ?>" /> <input type="button" class="button upload_image_button" value="CHANGE" name="browse" />
						</div>
					</div>
				<?php endif; ?>
			
				<h4><span>Alternative Content</span></h4>
				<?php if(cu3er__isFallback($baseUrl . '/fallback/')): ?>
				<div class="inputs">
					<label for="force">Force display JavaScript:</label> <input type="checkbox" id="force" name="settings[force_js]" value="yes"<?php echo ($slideshow['force_js'] == 'yes') ? ' checked="checked"' : '' ?> />
				</div>
				<?php endif; ?>
				<div class="textarea">
					<p class="description">This content will be displayed if Flash is not installed and if JS is not enabled:</p>
					<textarea name="settings[content]" id="content"><?php echo ($slideshow['content'] != '') ? $slideshow['content'] : '<p>If you do not see content of CU3ER slider here try to enable JavaScript and reload the page</p>'; ?></textarea>
				</div>
				<div class="submit">
					<input type="submit" class="button-primary"  value="Save Changes" name="Submit"> <span class="loading"></span>
				</div>
			</div>
			<br class="clear"/> 
		</div>
	</div>
	
	<h3 class="title">Slides and Transitions</h3>
			<div class="block">
				<div class="block-head">
					<div class="block-toggle"></div>
					<h4>Defaults Slide & Transition settings</h4> <span>This settings will apply to all existing slides and transitions.</span>
					<?php $default = cu3er__array_remove_empty($default); ?>
					<?php $default = array_merge($cu3er_defaults, $default); ?>
				</div>	
				<div class="block-inner" style="display: none;" id="defaultSlidesAndTransitions">
					<div class="transHalf">
						<input type="hidden" name="default[Defaults][id]" value="<?php echo $default['id']; ?>" />
						<h4><span>Slides size</span></h4>
						<div class="inputs">
							<label for="swidth">Width:</label> <input type="text" name="default[Defaults][swidth]" id="width" size="7" value="<?php echo $default['swidth'] ?>" />
						</div>
						<div class="inputs">
							<label for="height">Height:</label> <input type="text" name="default[Defaults][sheight]" id="height" size="7" value="<?php echo $default['sheight'] ?>" />
						</div>
						<h4><span>Slides align and offset</span></h4>
						<div class="inputs">
							<label for="salign_pos">Align:</label>
							<select name="default[Defaults][salign_pos]" id="salign_pos">
								<option value="TL"<?php echo ($default['salign_pos'] == 'TL') ? 'selected="selected"' : ''; ?>>Top-Left</option>
								<option value="TC"<?php echo ($default['salign_pos'] == 'TC') ? 'selected="selected"' : ''; ?>>Top-Center</option>
								<option value="TR"<?php echo ($default['salign_pos'] == 'TR') ? 'selected="selected"' : ''; ?>>Top-Right</option>
								<option value="ML"<?php echo ($default['salign_pos'] == 'ML') ? 'selected="selected"' : ''; ?>>Middle-Left</option>
								<option value="MC"<?php echo ($default['salign_pos'] == 'MC') ? 'selected="selected"' : ''; ?>>Middle-Center</option>
								<option value="MR"<?php echo ($default['salign_pos'] == 'MR') ? 'selected="selected"' : ''; ?>>Middle-Right</option>
								<option value="BL"<?php echo ($default['salign_pos'] == 'BL') ? 'selected="selected"' : ''; ?>>Bottom-Left</option>
								<option value="BC"<?php echo ($default['salign_pos'] == 'BC') ? 'selected="selected"' : ''; ?>>Bottom-Center</option>
								<option value="BR"<?php echo ($default['salign_pos'] == 'BR') ? 'selected="selected"' : ''; ?>>Bottom-Right</option>
							</select>
						</div>
						<div class="inputs">
							<label for="sx">X Offset:</label> <input type="text" name="default[Defaults][sx]" id="sx" size="7" value="<?php echo $default['sx'] ?>" />
						</div>
						<div class="inputs">
							<label for="sy">Y Offset:</label> <input type="text" name="default[Defaults][sy]" id="sy" size="7" value="<?php echo $default['sy'] ?>" />
						</div>
						<h4><span>Slide settings</span></h4>
						<div class="inputs">
							<label for="duration<?php echo $i; ?>">Duration:</label> <input type="text" name="default[Defaults][duration]" id="duration1" size="5" value="<?php echo $default['duration'] ?>" /> <span>seconds</span>
						</div>					
						<div class="inputs">
							<label for="color<?php echo $i; ?>">Color:</label> <input type="text" name="default[Defaults][color]" class="color" id="color<?php echo $i; ?>" size="5" value="<?php echo str_replace('0x', '#', $default['color']) ?>" />
						</div>
						<div class="inputs">
							<label for="link<?php echo $i; ?>">Link:</label> <input type="text" name="default[Defaults][link]" id="link<?php echo $i; ?>" value="<?php echo $default['link'] ?>" />
						</div>
						<div class="inputs">
							<label for="targetDefault">Target:</label>
							<select name="default[Defaults][target]" id="targetDefault">
								<option value="_self"<?php echo ($default['target'] == '_self') ? 'selected="selected"' : ''; ?>>_self</option>
								<option value="_blank"<?php echo ($default['target'] == '_blank') ? 'selected="selected"' : ''; ?>>_blank</option>
								<option value="_parent"<?php echo ($default['target'] == '_parent') ? 'selected="selected"' : ''; ?>>_parent</option>
								<option value="_top"<?php echo ($default['target'] == '_top') ? 'selected="selected"' : ''; ?>>_top</option>
							</select>
						</div>
						<h4><span>Description box</span></h4>
						<div class="inputs">
							<label for="dlink<?php echo $i; ?>">Link:</label> <input type="text" name="default[Defaults][dlink]" id="dlink<?php echo $i; ?>" value="<?php echo $default['dlink'] ?>" />
						</div>
						<div class="inputs">
							<label for="dtargetDefault">Target:</label>
							<select name="default[Defaults][dtarget]" id="dtargetDefault">
								<option value="_self"<?php echo ($default['dtarget'] == '_self') ? 'selected="selected"' : ''; ?>>_self</option>
								<option value="_blank"<?php echo ($default['dtarget'] == '_blank') ? 'selected="selected"' : ''; ?>>_blank</option>
								<option value="_parent"<?php echo ($default['dtarget'] == '_parent') ? 'selected="selected"' : ''; ?>>_parent</option>
								<option value="_top"<?php echo ($default['dtarget'] == '_top') ? 'selected="selected"' : ''; ?>>_top</option>
							</select>
						</div>
						<h4><span>SEO</span></h4>
						<div class="inputs">
							<label for="seo_show_image">Show image:</label> 
							<input id="seo_show_image" type="checkbox" name="default[Defaults][seo_show_image]" value="yes"<?php echo ($default['seo_show_image'] == 'yes') ? ' checked="checked"' : ''; ?> /> 
						</div>
						<div class="inputs">
							<label for="seo_show_heading">Show heading:</label> 
							<input id="seo_show_heading" type="checkbox" name="default[Defaults][seo_show_heading]" value="yes"<?php echo ($default['seo_show_heading'] == 'yes') ? ' checked="checked"' : ''; ?> /> 
						</div>
						<div class="inputs">
							<label for="seo_show_paragraph">Show paragraph:</label> 
							<input id="seo_show_paragraph" type="checkbox" name="default[Defaults][seo_show_paragraph]" value="yes"<?php echo ($default['seo_show_paragraph'] == 'yes') ? ' checked="checked"' : ''; ?> /> 
						</div>
						<div class="inputs">
							<label for="seo_show_caption">Show caption:</label> 
							<input id="seo_show_caption" type="checkbox" name="default[Defaults][seo_show_caption]" value="yes"<?php echo ($default['seo_show_caption'] == 'yes') ? ' checked="checked"' : ''; ?> /> 
						</div>
					</div>
				
					<div class="transHalf noBorder">
						<h4><span>Transition settings</span></h4>
						<div class="inputs">
							<label>Transition type</label>
							<input type="radio" name="default[Defaults][type]" value="3D"<?php echo ($default['type'] == '3D') ? ' checked="checked"' : '' ?> /> 3D
							<input type="radio" name="default[Defaults][type]" value="2D"<?php echo ($default['type'] == '2D') ? ' checked="checked"' : '' ?> /> 2D
						</div>
						<div class="inputs">
							<label for="columns<?php echo $i; ?>">Columns:</label> <input type="text" name="default[Defaults][columns]" id="columns<?php echo $i; ?>" size="5" value="<?php echo $default['columns'] ?>" />
						</div>
						<div class="inputs">
							<label for="rows<?php echo $i; ?>">Rows:</label> <input type="text" name="default[Defaults][rows]" id="rows<?php echo $i; ?>" size="5" value="<?php echo $default['rows'] ?>" />
						</div>
						<div class="inputs">
							<label for="type2d<?php echo $i; ?>">2D transition type:</label>
							<select name="default[Defaults][type2d]" id="type2d<?php echo $i; ?>">
								<option value="slide"<?php echo ($default['type2d'] == 'slide') ? 'selected="selected"' : ''; ?>>Slide/Glide</option>
								<option value="fade"<?php echo ($default['type2d'] == 'fade') ? 'selected="selected"' : ''; ?>>Fade</option>
							</select>
						</div>
						<div class="inputs">
							<label for="Flip Angle<?php echo $i; ?>">Flip angle:</label>
							<select name="default[Defaults][flipAngle]" id="flipAngle<?php echo $i; ?>">
								<option value="180"<?php echo ($default['flipAngle'] == 180) ? 'selected="selected"' : ''; ?>>180</option>
								<option value="90"<?php echo ($default['flipAngle'] == 90) ? 'selected="selected"' : ''; ?>>90</option>
							</select>							
						</div>
						<div class="inputs">
							<label for="flipOrder<?php echo $i; ?>">Flip order:</label>
							<select name="default[Defaults][flipOrder]" id="flipOrder<?php echo $i; ?>">
								<option value="0"<?php echo ($default['flipOrder'] === 0) ? 'selected="selected"' : ''; ?>>From Left to Right</option>
								<option value="315"<?php echo ($default['flipOrder'] == 315) ? 'selected="selected"' : ''; ?>>From Top-Left to Bottom-Right</option>
								<option value="270"<?php echo ($default['flipOrder'] == 270) ? 'selected="selected"' : ''; ?>>From Top to Bottom</option>
								<option value="225"<?php echo ($default['flipOrder'] == 225) ? 'selected="selected"' : ''; ?>>From Top-Right to Bottom-Left</option>
								<option value="180"<?php echo ($default['flipOrder'] == 180) ? 'selected="selected"' : ''; ?>>From Right to Left</option>
								<option value="135"<?php echo ($default['flipOrder'] == 135) ? 'selected="selected"' : ''; ?>>From Bottom-Right to Top-Left</option>
								<option value="90"<?php echo ($default['flipOrder'] == 90) ? 'selected="selected"' : ''; ?>>From Bottom to Top</option>
								<option value="45"<?php echo ($default['flipOrder'] == 45) ? 'selected="selected"' : ''; ?>>From Bottom-Left to Top-Right</option>
							</select>
						</div>

						<div class="inputs">
							<label for="flipOrderFromCenter<?php echo $i; ?>">Flip from	center:</label>
							<select name="default[Defaults][flipOrderFromCenter]" id="flipOrderFromCenter">
								<option value="true"<?php echo ($default['flipOrderFromCenter'] == 'true') ? 'selected="selected"' : ''; ?>>Yes</option>
								<option value="false"<?php echo ($default['flipOrderFromCenter'] == 'false') ? 'selected="selected"' : ''; ?>>No</option>
							</select>
						</div>
						<div class="inputs">
							<?php $directions = explode(",", $default['flipDirection']); ?>
							<label>Flip direction:</label> 
							<input type="checkbox" name="default[Defaults][flipDirection][0]" value="up"<?php echo (in_array('up', $directions)) ? ' checked="checked"' : ''; ?> /> UP
							<input type="checkbox" name="default[Defaults][flipDirection][1]" value="down"<?php echo (in_array('down', $directions)) ? ' checked="checked"' : ''; ?> /> DOWN
							<input type="checkbox" name="default[Defaults][flipDirection][2]" value="left"<?php echo (in_array('left', $directions)) ? ' checked="checked"' : ''; ?> /> LEFT
							<input type="checkbox" name="default[Defaults][flipDirection][3]" value="right"<?php echo (in_array('right', $directions)) ? ' checked="checked"' : ''; ?> /> RIGHT
						</div>
						<div class="inputs">
							<label for="flipColor<?php echo $i; ?>">Flip color:</label> <input type="text" name="default[Defaults][flipColor]" id="flipColor<?php echo $i; ?>" size="5" value="<?php echo str_replace('0x', '#', $default['flipColor']) ?>" class="color" /> 
						</div>
						
						<div class="inputs">
							<label for="flipShader">Use shading:</label>
							<select name="default[Defaults][flipShader]" id="flipOrderFromCenter">
								<option value="flat"<?php echo ($default['flipShader'] == 'flat') ? 'selected="selected"' : ''; ?>>Yes</option>
								<option value="none"<?php echo ($default['flipShader'] == 'none') ? 'selected="selected"' : ''; ?>>No</option>
							</select>
						</div>
						
						<div class="inputs">
							<label for="flipBoxDepth<?php echo $i; ?>">Flip box thickness:</label> <input type="text" name="default[Defaults][flipBoxDepth]" id="flipBoxDepth<?php echo $i; ?>" size="5" value="<?php echo $default['flipBoxDepth'] ?>" />
						</div>
						<div class="inputs">
							<label for="flipDepth<?php echo $i; ?>">Flip depth:</label> <input type="text" name="default[Defaults][flipDepth]" id="flipDepth<?php echo $i; ?>" size="5" value="<?php echo $default['flipDepth'] ?>" />
						</div>
						<div class="inputs">
							<label for="flipEasing<?php echo $i; ?>">Flip easing:</label>
							<select name="default[Defaults][flipEasing]" id="flipEasing<?php echo $i; ?>">
								<option value="Sine.easeOut"<?php echo ($default['flipEasing'] == 'Sine.easeOut') ? 'selected="selected"' : ''; ?>>Sine.easeOut</option>
								<option value="Sine.easeInOut"<?php echo ($default['flipEasing'] == 'Sine.easeInOut') ? 'selected="selected"' : ''; ?>>Sine.easeInOut</option>
								<option value="Sine.easeIn"<?php echo ($default['flipEasing'] == 'Sine.easeIn') ? 'selected="selected"' : ''; ?>>Sine.easeIn</option>
								<option value="Bounce.easeOut"<?php echo ($default['flipEasing'] == 'Bounce.easeOut') ? 'selected="selected"' : ''; ?>>Bounce.easeOut</option>
								<option value="Bounce.easeInOut"<?php echo ($default['flipEasing'] == 'Bounce.easeInOut') ? 'selected="selected"' : ''; ?>>Bounce.easeInOut</option>
								<option value="Bounce.easeIn"<?php echo ($default['flipEasing'] == 'Bounce.easeIn') ? 'selected="selected"' : ''; ?>>Bounce.easeIn</option>
								<option value="Elastic.easeOut"<?php echo ($default['flipEasing'] == 'Elastic.easeOut') ? 'selected="selected"' : ''; ?>>Elastic.easeOut</option>
								<option value="Elastic.easeInOut"<?php echo ($default['flipEasing'] == 'Elastic.easeInOut') ? 'selected="selected"' : ''; ?>>Elastic.easeInOut</option>
								<option value="Elastic.easeIn"<?php echo ($default['flipEasing'] == 'Elastic.easeIn') ? 'selected="selected"' : ''; ?>>Elastic.easeIn</option>
								<option value="Expo.easeOut"<?php echo ($default['flipEasing'] == 'Expo.easeOut') ? 'selected="selected"' : ''; ?>>Expo.easeOut</option>
								<option value="Expo.easeInOut"<?php echo ($default['flipEasing'] == 'Expo.easeInOut') ? 'selected="selected"' : ''; ?>>Expo.easeInOut</option>
								<option value="Expo.easeIn"<?php echo ($default['flipEasing'] == 'Expo.easeIn') ? 'selected="selected"' : ''; ?>>Expo.easeIn</option>
							</select>
						</div>
						<div class="inputs">
							<label for="rows<?php echo $i; ?>">Flip duration:</label> <input type="text" name="default[Defaults][flipDuration]" id="flipDuration<?php echo $i; ?>" size="5" value="<?php echo $default['flipDuration'] ?>" />
						</div>
						<div class="inputs">
							<label for="flipDelay<?php echo $i; ?>">Flip delay:</label> <input type="text" name="default[Defaults][flipDelay]" id="flipDelay<?php echo $i; ?>" size="5" value="<?php echo $default['flipDelay'] ?>" />
						</div>
						<div class="inputs">
							<label for="rows<?php echo $i; ?>">Flip delay randomize:</label> <input type="text" name="default[Defaults][flipDelayRandomize]" id="flipDelayRandomize<?php echo $i; ?>" size="5" value="<?php echo $default['flipDelayRandomize'] ?>" />
						</div>
						<input type="hidden" name="default[Defaults][corner_TL]" value="<?php echo $default['corner_TL']; ?>" />
						<input type="hidden" name="default[Defaults][corner_TR]" value="<?php echo $default['corner_TR']; ?>" />
						<input type="hidden" name="default[Defaults][corner_BL]" value="<?php echo $default['corner_BL']; ?>" />
						<input type="hidden" name="default[Defaults][corner_BR]" value="<?php echo $default['corner_BR']; ?>" />
						<!--<input type="hidden" name="default[Defaults][swidth]" value="<?php echo $default['swidth']; ?>" />
						<input type="hidden" name="default[Defaults][sheight]" value="<?php echo $default['sheight']; ?>" />-->
						<input type="hidden" name="default[Defaults][thumb_width]" value="<?php echo $default['thumb_width']; ?>" />
						<input type="hidden" name="default[Defaults][thumb_height]" value="<?php echo $default['thumb_height']; ?>" />
						<input type="hidden" name="default[Defaults][transparent]" value="<?php echo $default['transparent']; ?>" />
					</div>
					<br class="clear"/> 
				</div>
			</div>
			<?php $i++; ?>
		<input type="submit" class="button-primary"  value="Save Changes" name="Submit">
		<input type="button" class="button previewButton" value="Preview" name="browse" rel="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&id=<?php echo $slideshow['id']; ?>&TB_iframe=true" />
		<?php if(cu3er__isFallback($baseUrl . '/fallback/')): ?>
		<input type="button" class="button previewButton" value="Preview JS" name="browse" rel="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&force_js=true&id=<?php echo $slideshow['id']; ?>&TB_iframe=true" />
		<?php endif; ?>
		 <span class="loading"></span>
	
	<input type="button" class="button addTransition" value="Add Slide & Transition" />
	
		<input type="hidden" name="slideshow_id" value="<?php echo $_GET['id']; ?>" />
		<div id="slidesAndTransitionsHolder">
			<?php $i = 0; ?>
			<?php foreach($slides as $slide): ?>
			<div class="block">
				<div class="block-head">
					<div class="block-toggle"></div>
					<h4>#<?php echo ($i + 1); ?> Slide & Transition</h4> <span class="delete" style="float:right;color:red;"><a href="#">Delete</a></span> <span class="duplicate" style="float:right;"><a href="#" rel="<?php echo $i; ?>">Duplicate</a> </span>
				</div>
				<?php $slide = cu3er__array_remove_empty($slide); ?>
				<?php $original = $slide; ?>
				<?php $slide = array_merge($cu3er_defaults, $default, $slide); ?>
				<div class="block-inner" style="display: none;">
					<div class="transHalf">
						<h4><span>Slide image</span></h4>
						<div class="inputs slide">
							<span class="imageHolder">
								<?php 
									if(cu3er__isImage($slideshow['images_folder'] . '/' . $slide['image'])) {
										$image = $slideshow['images_folder'] . '/' . $slide['image']; 
									} elseif(cu3er__isHttpPath($slide['image'])) {
										if(cu3er__isImage($slide['image'])) {
											$image = $slide['image'];
										} else {
											$image = $defaultImage;
										}
									} else {
										$image = $defaultImage;
									}
									$imgSize = getimagesize($image);
									$size = ($imgSize['width'] < $imgSize['height']) ? 'height="80"' : 'width="80"';
								?>
								<img src="<?php echo $image; ?>" <?php echo $size; ?> />
							</span>
							<div class="imageUrl">
								<input type="hidden" name="slide[<?php echo $i; ?>][id]" value="<?php echo $slide['id'] ?>">
								<input type="hidden" name="slide[<?php echo $i; ?>][position]" value="<?php echo ($slide['position'] > 0) ? $slide['position'] : $i; ?>" class="positionHidden">
								<label for="image<?php echo $i; ?>">Image URL:</label> <input type="text" class="imageField" name="slide[<?php echo $i; ?>][image]" id="image<?php echo $i; ?>" value="<?php echo $slide['image'] ?>" /> <input type="button" class="button upload_image_button" value="CHANGE" name="browse" />
								<div class="inputs">
									<label for="use_image<?php echo $i; ?>" style="width:80px;">Use image:</label> <input type="checkbox" name="slide[<?php echo $i; ?>][use_image]" id="use_image<?php echo $i; ?>" style="margin-top:6px;" value="yes"<?php echo ($slide['use_image'] == 'yes') ? ' checked="checked"' : ''; ?> /> &nbsp;
								</div>
							</div>
						</div>
					
						<h4><span>Slide settings</span></h4>
						<div class="inputs<?php echo ($original['duration'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="duration<?php echo $i; ?>">Duration:</label> <input type="text" name="slide[<?php echo $i; ?>][duration]" id="duration1" size="5" value="<?php echo $slide['duration'] ?>" /> <span>seconds</span>
						</div>					
						<div class="inputs<?php echo ($original['color'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="color<?php echo $i; ?>">Color:</label> <input type="text" name="slide[<?php echo $i; ?>][color]" id="color<?php echo $i; ?>" size="5" value="<?php echo str_replace('0x', '#', $slide['color']) ?>" class="color" />
						</div>
						<div class="inputs<?php echo ($original['caption'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="caption<?php echo $i; ?>">Caption:</label> <input type="text" name="slide[<?php echo $i; ?>][caption]" id="caption<?php echo $i; ?>" value="<?php echo $slide['caption'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['link'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="link<?php echo $i; ?>">Link:</label> <input type="text" name="slide[<?php echo $i; ?>][link]" id="link<?php echo $i; ?>" value="<?php echo $slide['link'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['target'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="target<?php echo $i; ?>">Target:</label>
							<select name="slide[<?php echo $i; ?>][target]" id="target<?php echo $i; ?>">
								<option value="_self"<?php echo ($slide['target'] == '_self') ? 'selected="selected"' : ''; ?>>_self</option>
								<option value="_blank"<?php echo ($slide['target'] == '_blank') ? 'selected="selected"' : ''; ?>>_blank</option>
								<option value="_parent"<?php echo ($slide['target'] == '_parent') ? 'selected="selected"' : ''; ?>>_parent</option>
								<option value="_top"<?php echo ($slide['target'] == '_top') ? 'selected="selected"' : ''; ?>>_top</option>
							</select>
						</div>
						<h4><span>Description box</span></h4>
						<div class="textarea<?php echo ($original['heading'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="heading<?php echo $i; ?>">Heading text:</label>
							<textarea name="slide[<?php echo $i; ?>][heading]" id="heading<?php echo $i; ?>" rows="4" cols="43"><?php echo stripslashes($slide['heading']); ?></textarea>
						</div>
						<div class="textarea<?php echo ($original['paragraph'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="paragraph<?php echo $i; ?>">Paragraph text:</label>
							<textarea name="slide[<?php echo $i; ?>][paragraph]" id="paragraph<?php echo $i; ?>" rows="4" cols="43"><?php echo stripslashes($slide['paragraph']); ?></textarea>
						</div>
						<div class="inputs<?php echo ($original['dlink'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="dlink<?php echo $i; ?>">Link:</label> <input type="text" name="slide[<?php echo $i; ?>][dlink]" id="dlink<?php echo $i; ?>" value="<?php echo $slide['dlink'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['dtarget'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="dtarget<?php echo $i; ?>">Target:</label>
							<select name="slide[<?php echo $i; ?>][dtarget]" id="dtarget<?php echo $i; ?>">
								<option value="_self"<?php echo ($slide['dtarget'] == '_self') ? 'selected="selected"' : ''; ?>>_self</option>
								<option value="_blank"<?php echo ($slide['dtarget'] == '_blank') ? 'selected="selected"' : ''; ?>>_blank</option>
								<option value="_parent"<?php echo ($slide['dtarget'] == '_parent') ? 'selected="selected"' : ''; ?>>_parent</option>
								<option value="_top"<?php echo ($slide['dtarget'] == '_top') ? 'selected="selected"' : ''; ?>>_top</option>
							</select>
						</div>
						<h4><span>SEO</span></h4>
						<div class="inputs<?php echo ($original['seo_show_image'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="seo_show_image<?php echo $i; ?>">Show image:</label> 
							<input id="seo_show_image<?php echo $i; ?>" type="checkbox" name="slide[<?php echo $i; ?>][seo_show_image]" value="yes"<?php echo ($original['seo_show_image'] == 'yes') ? ' checked="checked"' : ''; ?> /> 
						</div>
						<div class="inputs<?php echo ($original['seo_show_heading'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="seo_show_heading<?php echo $i; ?>">Show heading:</label> 
							<input id="seo_show_heading<?php echo $i; ?>" type="checkbox" name="slide[<?php echo $i; ?>][seo_show_heading]" value="yes"<?php echo ($original['seo_show_heading'] == 'yes') ? ' checked="checked"' : ''; ?> /> 
						</div>
						<div class="inputs<?php echo ($original['seo_show_paragraph'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="seo_show_paragraph<?php echo $i; ?>">Show paragraph:</label> 
							<input id="seo_show_paragraph<?php echo $i; ?>" type="checkbox" name="slide[<?php echo $i; ?>][seo_show_paragraph]" value="yes"<?php echo ($original['seo_show_paragraph'] == 'yes') ? ' checked="checked"' : ''; ?> /> 
						</div>
						<div class="inputs<?php echo ($original['seo_show_caption'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="seo_show_caption<?php echo $i; ?>">Show caption:</label> 
							<input id="seo_show_caption<?php echo $i; ?>" type="checkbox" name="slide[<?php echo $i; ?>][seo_show_caption]" value="yes"<?php echo ($original['seo_show_caption'] == 'yes') ? ' checked="checked"' : ''; ?> /> 
						</div>
						<div class="textarea<?php echo ($original['seo_text'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="seo_text<?php echo $i; ?>">Custom text:</label>
							<textarea name="slide[<?php echo $i; ?>][seo_text]" id="seo_text<?php echo $i; ?>" rows="4" cols="43"><?php echo stripslashes($slide['seo_text']); ?></textarea>
						</div>
						<div class="textarea<?php echo ($original['seo_img_alt'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="seo_img_alt<?php echo $i; ?>">Image alt text:</label>
							<textarea name="slide[<?php echo $i; ?>][seo_img_alt]" id="seo_img_alt<?php echo $i; ?>" rows="4" cols="43"><?php echo stripslashes($slide['seo_img_alt']); ?></textarea>
						</div>
					</div>
				
					<div class="transHalf noBorder">
						<h4><span>Transition settings</span></h4>
						<div class="inputs<?php echo ($original['type'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label>Transition type:</label>
							<input type="radio" name="slide[<?php echo $i; ?>][type]" value="3D"<?php echo ($slide['type'] == '3D') ? ' checked="checked"' : '' ?> /> 3D
							<input type="radio" name="slide[<?php echo $i; ?>][type]" value="2D"<?php echo ($slide['type'] == '2D') ? ' checked="checked"' : '' ?> /> 2D
						</div>
						<div class="inputs<?php echo ($original['columns'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="columns<?php echo $i; ?>">Columns:</label> <input type="text" name="slide[<?php echo $i; ?>][columns]" id="columns<?php echo $i; ?>" size="5" value="<?php echo $slide['columns'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['rows'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="rows<?php echo $i; ?>">Rows:</label> <input type="text" name="slide[<?php echo $i; ?>][rows]" id="rows<?php echo $i; ?>" size="5" value="<?php echo $slide['rows'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['type2d'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="type2d<?php echo $i; ?>">2D transition type:</label>
							<select name="slide[<?php echo $i; ?>][type2d]" id="type2d<?php echo $i; ?>">
								<option value="slide"<?php echo ($slide['type2d'] == 'slide') ? 'selected="selected"' : ''; ?>>Slide/Glide</option>
								<option value="fade"<?php echo ($slide['type2d'] == 'fade') ? 'selected="selected"' : ''; ?>>Fade</option>
							</select>
						</div>
						<div class="inputs<?php echo ($original['flipAngle'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipAngle<?php echo $i; ?>">Flip angle:</label>
							<select name="slide[<?php echo $i; ?>][flipAngle]" id="flipAngle<?php echo $i; ?>">
								<option value="180"<?php echo ($slide['flipAngle'] == 180) ? 'selected="selected"' : ''; ?>>180</option>
								<option value="90"<?php echo ($slide['flipAngle'] == 90) ? 'selected="selected"' : ''; ?>>90</option>
							</select>
						</div>
						<div class="inputs<?php echo ($original['flipOrder'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipOrder<?php echo $i; ?>">Flip order:</label>
							<select name="slide[<?php echo $i; ?>][flipOrder]" id="flipOrder<?php echo $i; ?>">
								<option value="0"<?php echo ($slide['flipOrder'] === 0) ? 'selected="selected"' : ''; ?>>From Left to Right</option>
								<option value="315"<?php echo ($slide['flipOrder'] == 315) ? 'selected="selected"' : ''; ?>>From Top-Left to Bottom-Right</option>
								<option value="270"<?php echo ($slide['flipOrder'] == 270) ? 'selected="selected"' : ''; ?>>From Top to Bottom</option>
								<option value="225"<?php echo ($slide['flipOrder'] == 225) ? 'selected="selected"' : ''; ?>>From Top-Right to Bottom-Left</option>
								<option value="180"<?php echo ($slide['flipOrder'] == 180) ? 'selected="selected"' : ''; ?>>From Right to Left</option>
								<option value="135"<?php echo ($slide['flipOrder'] == 135) ? 'selected="selected"' : ''; ?>>From Bottom-Right to Top-Left</option>
								<option value="90"<?php echo ($slide['flipOrder'] == 90) ? 'selected="selected"' : ''; ?>>From Bottom to Top</option>
								<option value="45"<?php echo ($slide['flipOrder'] == 45) ? 'selected="selected"' : ''; ?>>From Bottom-Left to Top-Right</option>
							</select>
						</div>

						<div class="inputs<?php echo ($original['flipOrderFromCenter'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipOrderFromCenter<?php echo $i; ?>">Flip from center:</label>
							<select name="slide[<?php echo $i; ?>][flipOrderFromCenter]" id="flipOrderFromCenter<?php echo $i; ?>">
								<option value="true"<?php echo ($slide['flipOrderFromCenter'] == 'true') ? 'selected="selected"' : ''; ?>>Yes</option>
								<option value="false"<?php echo ($slide['flipOrderFromCenter'] == 'false') ? 'selected="selected"' : ''; ?>>No</option>
							</select>
						</div>
						<div class="inputs<?php echo ($original['flipDirection'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<?php $directions = explode(",", $slide['flipDirection']); ?>
							<label>Flip direction:</label> 
							<input type="checkbox" name="slide[<?php echo $i; ?>][flipDirection][0]" value="up"<?php echo (in_array('up', $directions)) ? ' checked="checked"' : ''; ?> /> UP
							<input type="checkbox" name="slide[<?php echo $i; ?>][flipDirection][1]" value="down"<?php echo (in_array('down', $directions)) ? ' checked="checked"' : ''; ?> /> DOWN
							<input type="checkbox" name="slide[<?php echo $i; ?>][flipDirection][2]" value="left"<?php echo (in_array('left', $directions)) ? ' checked="checked"' : ''; ?> /> LEFT
							<input type="checkbox" name="slide[<?php echo $i; ?>][flipDirection][3]" value="right"<?php echo (in_array('right', $directions)) ? ' checked="checked"' : ''; ?> /> RIGHT
						</div>
						<div class="inputs<?php echo ($original['flipColor'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipColor<?php echo $i; ?>">Flip color:</label> <input type="text" name="slide[<?php echo $i; ?>][flipColor]" id="flipColor<?php echo $i; ?>" size="5" value="<?php echo str_replace('0x', '#', $slide['flipColor']) ?>" class="color" />
						</div>
						<div class="inputs<?php echo ($original['flipShader'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipShader<?php echo $i; ?>">Use shading:</label>
							<select name="slide[<?php echo $i; ?>][flipShader]" id="flipShader<?php echo $i; ?>">
								<option value="flat"<?php echo ($slide['flipShader'] == 'flat') ? 'selected="selected"' : ''; ?>>Yes</option>
								<option value="none"<?php echo ($slide['flipShader'] == 'none') ? 'selected="selected"' : ''; ?>>No</option>
							</select>
						</div>
						<div class="inputs<?php echo ($original['flipBoxDepth'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipBoxDepth<?php echo $i; ?>">Flip box thickness:</label> <input type="text" name="slide[<?php echo $i; ?>][flipBoxDepth]" id="flipBoxDepth<?php echo $i; ?>" size="5" value="<?php echo $slide['flipBoxDepth'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['flipDepth'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipDepth<?php echo $i; ?>">Flip depth:</label> <input type="text" name="slide[<?php echo $i; ?>][flipDepth]" id="flipDepth<?php echo $i; ?>" size="5" value="<?php echo $slide['flipDepth'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['flipEasing'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipEasing<?php echo $i; ?>">Flip easing:</label>
							<select name="slide[<?php echo $i; ?>][flipEasing]" id="flipEasing<?php echo $i; ?>">
								<option value="Sine.easeOut"<?php echo ($slide['flipEasing'] == 'Sine.easeOut') ? 'selected="selected"' : ''; ?>>Sine.easeOut</option>
								<option value="Sine.easeInOut"<?php echo ($slide['flipEasing'] == 'Sine.easeInOut') ? 'selected="selected"' : ''; ?>>Sine.easeInOut</option>
								<option value="Sine.easeIn"<?php echo ($slide['flipEasing'] == 'Sine.easeIn') ? 'selected="selected"' : ''; ?>>Sine.easeIn</option>
								<option value="Bounce.easeOut"<?php echo ($slide['flipEasing'] == 'Bounce.easeOut') ? 'selected="selected"' : ''; ?>>Bounce.easeOut</option>
								<option value="Bounce.easeInOut"<?php echo ($slide['flipEasing'] == 'Bounce.easeInOut') ? 'selected="selected"' : ''; ?>>Bounce.easeInOut</option>
								<option value="Bounce.easeIn"<?php echo ($slide['flipEasing'] == 'Bounce.easeIn') ? 'selected="selected"' : ''; ?>>Bounce.easeIn</option>
								<option value="Elastic.easeOut"<?php echo ($slide['flipEasing'] == 'Elastic.easeOut') ? 'selected="selected"' : ''; ?>>Elastic.easeOut</option>
								<option value="Elastic.easeInOut"<?php echo ($slide['flipEasing'] == 'Elastic.easeInOut') ? 'selected="selected"' : ''; ?>>Elastic.easeInOut</option>
								<option value="Elastic.easeIn"<?php echo ($slide['flipEasing'] == 'Elastic.easeIn') ? 'selected="selected"' : ''; ?>>Elastic.easeIn</option>
								<option value="Expo.easeOut"<?php echo ($slide['flipEasing'] == 'Expo.easeOut') ? 'selected="selected"' : ''; ?>>Expo.easeOut</option>
								<option value="Expo.easeInOut"<?php echo ($slide['flipEasing'] == 'Expo.easeInOut') ? 'selected="selected"' : ''; ?>>Expo.easeInOut</option>
								<option value="Expo.easeIn"<?php echo ($slide['flipEasing'] == 'Expo.easeIn') ? 'selected="selected"' : ''; ?>>Expo.easeIn</option>
							</select>
						</div>
						<div class="inputs<?php echo ($original['flipDuration'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipDuration<?php echo $i; ?>">Flip duration:</label> <input type="text" name="slide[<?php echo $i; ?>][flipDuration]" id="flipDuration<?php echo $i; ?>" size="5" value="<?php echo $slide['flipDuration'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['flipDelay'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipDelay<?php echo $i; ?>">Flip delay:</label> <input type="text" name="slide[<?php echo $i; ?>][flipDelay]" id="flipDelay<?php echo $i; ?>" size="5" value="<?php echo $slide['flipDelay'] ?>" />
						</div>
						<div class="inputs<?php echo ($original['flipDelayRandomize'] == '') ? ' CU3ER-emptyValue' : ''; ?>">
							<label for="flipDelayRandomize<?php echo $i; ?>">Flip delay randomize:</label> <input type="text" name="slide[<?php echo $i; ?>][flipDelayRandomize]" id="flipDelayRandomize<?php echo $i; ?>" size="5" value="<?php echo $slide['flipDelayRandomize'] ?>" />
						</div>
						<div class="<?php echo ($original['align_pos'] == '') ? 'CU3ER-emptyValue' : '' ?>">
							<input type="hidden" name="slide[<?php echo $i; ?>][align_pos]" value="<?php echo $slide['align_pos']; ?>" />
						</div>
						<div class="<?php echo ($original['x'] == '') ? 'CU3ER-emptyValue' : '' ?>">
							<input type="hidden" name="slide[<?php echo $i; ?>][x]" value="<?php echo $slide['x']; ?>" />
						</div>
						<div class="<?php echo ($original['y'] == '') ? 'CU3ER-emptyValue' : '' ?>">
							<input type="hidden" name="slide[<?php echo $i; ?>][y]" value="<?php echo $slide['y']; ?>" />
						</div>
						<div class="<?php echo ($original['scaleX'] == '') ? 'CU3ER-emptyValue' : '' ?>">
							<input type="hidden" name="slide[<?php echo $i; ?>][scaleX]" value="<?php echo $slide['scaleX']; ?>" />
						</div>
						<div class="<?php echo ($original['scaleY'] == '') ? 'CU3ER-emptyValue' : '' ?>">
							<input type="hidden" name="slide[<?php echo $i; ?>][scaleY]" value="<?php echo $slide['scaleY']; ?>" />
						</div>
						<div class="<?php echo ($original['transparent'] == '') ? 'CU3ER-emptyValue' : '' ?>">
							<input type="hidden" name="slide[<?php echo $i; ?>][transparent]" value="<?php echo $slide['transparent']; ?>" />
						</div>
					</div>
					<br class="clear"/> 
				</div>
			</div>
			<?php $i++; ?>
			<?php endforeach; ?>
		</div>
		<input type="submit" class="button-primary"  value="Save Changes" name="Submit" id="end"> <input type="button" class="button addTransition" value="Add Slide & Transition" />
		<input type="button" class="button previewButton" value="Preview" name="browse" rel="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&id=<?php echo $slideshow['id']; ?>&TB_iframe=true" /> 
		<?php if(cu3er__isFallback($baseUrl . '/fallback/')): ?>
		<input type="button" class="button previewButton" value="Preview JS" name="browse" rel="<?php echo WP_PLUGIN_URL; ?>/wpcu3er/php/ajaxReq.php?act=preview&force_js=true&id=<?php echo $slideshow['id']; ?>&TB_iframe=true" />
		<?php endif; ?>
		 <span class="loading"></span>
	</form>
	
	<br class="clear"/>
</div>
