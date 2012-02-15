<?php
# cannot call this file directly
if ( strpos( basename( $_SERVER['PHP_SELF']) , __FILE__ ) !== false ) exit;
include_once('header.php');
?>
<div class="wrap wrap-CU3ER" id="CU3ER-content">

 	<?php echo $jsonContents; ?>
	<div class="icon32" id="icon-edit"><br></div>
	<h2>Add New</h2>	
	<?php include_once('warnings.php'); ?>
	<p>To create a new CU3ER please upload either CU3ER zip project file or XML configurations file, or you also can use URL to the XML configuration file.</p>
	
	<div id="importHolder">
		<form name="importCU3ER" method="post" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="512000000" />
			<h3>Create new slider</h3>
			<div class="inputs">
				<label for="name">Name:</label> <input type="text" name="name" id="name" /> <span class="description">Set name of your CU3ER project.</span>
			</div>
			<div class="selectType">
				<div class="inputs">
					<label for="name">Configuration files:</label><label><select id="selectMe"><option value="1">Upload XML or ZIP </option><option value="2">XML URL Location</option></select></label><br />

<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#selectMe").bind('change', function() {
		if(jQuery(this).val() == 2) {
			jQuery("#xml").hide();
			jQuery("#url").show();
		} else {
			jQuery("#xml").show();
			jQuery("#url").hide();
		}
	});
});
</script>
				
			</div>
			<div id="xml" class="inputs">
					<input type="file" name="import1" id="import1" /> 
				</div>
				<div class="inputs" id="url">
					<input type="text" name="import2" id="import2" /><span class="description"> Enter xml location.</span> 
				</div>
			<div class="submit">
				<input type="submit" class="button-primary" value="Add CU3ER" name="Submit" id="submit">
			</div>
		</form>
	</div>
	
	<br class="clear"/> 
</div>
