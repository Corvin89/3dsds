<?php
	# cannot call this file directly
	if ( strpos( basename( $_SERVER['PHP_SELF']) , __FILE__ ) !== false ) exit;
	# overview page
	include_once('header.php');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#licence').val('<?php echo mysql_real_escape_string(urldecode($settings["licence"])); ?>');
		$('#licence1').val('<?php echo mysql_real_escape_string(urldecode($settings["licence1"])); ?>');
		$('#licence2').val('<?php echo mysql_real_escape_string(urldecode($settings["licence2"])); ?>');
		$('#licence3').val('<?php echo mysql_real_escape_string(urldecode($settings["licence3"])); ?>');
		$('#licence4').val('<?php echo mysql_real_escape_string(urldecode($settings["licence4"])); ?>');
	});
</script>
<div class="wrap wrap-CU3ER">
	<div class="icon32" id="icon-options-general"><br></div>
	<h2>wpCU3ER Setup</h2>
	<?php include('warnings.php'); ?>
	<a name="uploadCU3ER"></a>
	<form method="post" action="admin.php?page=CU3ERSetup" enctype="multipart/form-data" class="CU3ER-">
		<input type="hidden" name="settings[id]" value="<?php echo $settings['id']; ?>" />
		<h3 id="swf-upload">CU3ER SWF & JavaScript File Upload</h3>
		<span><?php if (!empty($settings['cu3er_location']))  {?>Current CU3ER.swf location: <code><?php  echo $settings['cu3er_location'] ?></code><?php
        } else {
          echo "Missing CU3ER.swf";
        } ?></span>
		<div class="inputs">
		    <label for="cu3er_location">CU3ER.swf file:</label> <input type="file" name="cu3er_location" id="cu3er_location" accept="application/x-shockwave-flash" />
		</div>
		<?php if (!empty($settings['js_location'])) { ?><span>Current jquery.cu3er.js location: <code><?php echo $settings['js_location'] ?></code></span><?php } ?>
		<div class="inputs">
		<label for="js_location">jquery.cu3er.js file:</label> <input type="file" name="js_location" id="js_location" accept="application/javascript" />
		</div>
		<?php if (!empty($settings['js_player_location'])) { ?><span>Current jquery.cu3er.player.js location: <code><?php echo $settings['js_player_location'] ?></code></span><?php } ?>
		<div class="inputs">
		<label for="js_location">jquery.cu3er.player.js file:</label> <input type="file" name="js_player_location" id="js_player_location" accept="application/javascript" /><span class="description">(optional) </span>
		</div>
		<h3>Licence</h3>
		<div class="inputs">
			<label for="licence">CU3ER Licence:</label> <input type="text" name="settings[licence]" id="licence" value="<?php //echo $settings['licence'] ?>" size="36" /> <span class="description">NOTE: CU3ER brand removing will work only if correct license is used! <a href="http://docs.getcu3er.com/wpcu3er/setup#licence" target="_blank">Learn more.</a></span>
		</div>
		<div class="inputs">
			<label for="licence1">CU3ER Licence:</label> <input type="text" name="settings[licence1]" id="licence1" value="<?php //echo $settings['licence'] ?>" size="36" />
		</div>
		<div class="inputs">
			<label for="licence2">CU3ER Licence:</label> <input type="text" name="settings[licence2]" id="licence2" value="<?php //echo $settings['licence'] ?>" size="36" />
		</div>
		<div class="inputs">
			<label for="licence3">CU3ER Licence:</label> <input type="text" name="settings[licence3]" id="licence3" value="<?php //echo $settings['licence'] ?>" size="36" />
		</div>
		<div class="inputs">
			<label for="licence4">CU3ER Licence:</label> <input type="text" name="settings[licence4]" id="licence4" value="<?php //echo $settings['licence'] ?>" size="36" />
		</div>
		<div class="inputs">
			<label for="branding">Remove branding:</label> <input type="checkbox" name="settings[branding]" id="branding"<?php echo ($settings['branding'] == 'yes') ? ' checked="checked"' : ''; ?> value="yes" /> 
		</div>
		<input type="submit" class="button-primary setup-button" value="Save Changes" name="Submit">
	</form>
	<br class="clear"/>
</div>
