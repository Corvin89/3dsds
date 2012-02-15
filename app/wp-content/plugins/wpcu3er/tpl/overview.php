<?php
	# cannot call this file directly
	if ( strpos( basename( $_SERVER['PHP_SELF']) , __FILE__ ) !== false ) exit;
	# overview page
	include_once('header.php');
?>
<div class="wrap wrap-CU3ER metabox-holder">
	<?php include_once('warnings.php'); ?>
	<h2 class="title">Overview</h2>
<div class="postbox-container" style="width:75%">
<div class="postbox" id="dashboard_plugins">
<h3>Welcome to wpCU3ER!</h3>
	<div class="inside">		
		<p>
		<strong><a href="http://getcu3er.com/fetaures/wpcu3er" target="_blank">wpCU3ER</a></strong> is
		WordPress plugin designed to provide easy <a href="http://getcu3er.com" target="_blank"><strong>CU3ER</strong></a> integration
		into WordPress powered web sites while offering lots of advanced <a href="http://getcu3er.com" target="_blank"><strong>CU3ER</strong></a>
		content editing & managing features:
		</p>
		<ul  class="bullets">
			<li>No coding required</li>
			<li>Your clients can mange CU3ER by their own</li>
			<li>Hassle free post/page embedding</li>
			<li>Content management through WordPress</li>
			<li>Template tag embedding for custom designs</li>
			<li>Import CU3ER projects with all related files (images &amp; fonts)</li>
			<li>Add, remove or reorder slides &amp; transitions </li>
			<li>Completely manage slide &amp; transition settings</li>
			<li>Change images, heading &amp; paragraph text</li>
			<li>Edit, preview &amp; manage CU3ER projects within WP admin any time.</li>
			<li>and of course &mdash; it's free.</li>
		</ul>	
		
		<p style="margin:18px 0 20px; padding:20px 0 7px 17px; border-top:solid 1px #ccc;">
		<?php if(sizeof($slideshows)): ?>
			<a href="admin.php?page=CU3ERAddNew" class="button">Add New CU3ER</a>
			<a href="admin.php?page=CU3ERManageAll" class="button">Edit CU3ER</a>
			<a href="http://docs.getcu3er.com/wpcu3er/" target="_blank" class="button">Documentation</a>
		<?php else: ?>
			<a class="button" href="admin.php?page=CU3ERAddNew">Create your first CU3ER project</a>
			<a href="http://docs.getcu3er.com/wpcu3er/" target="_blank" class="button">View documentation</a>
		<?php endif; ?>
		</p>
	</div>
</div>

<div class="postbox" id="dashboard_plugins">
<h3>Quick Start</h3>
	<div class="inside">
	
<ol id="quickStart">
<li>
<h4 style="text-decoration:line-through; color:#999;">Install wpCU3ER plugin</h4>
<p>
If you are reading this section you have obviously successfully installed wpCU3ER
plugin.
</p>
</li>
<li>
	<h4>Sign-up for CU3ER account</h4>
	<p>
	If you don't have CU3ER account yet, please <a href="http://getcu3er.com/#signup" target="_blank">create
	your CU3ER account</a>.
	</p>
</li>
<li>
<h4>Create project in cManager</h4>
<p>
<a href="http://getcu3er.com/features/cu3er-manager" target="_blank">cManager</a> is online application designed to make CU3ER development as fast and easy as possible. 
For more info about working with cManager please check <a href="http://docs.getcu3er.com/cmanager/" target="_blank">official
documentation</a>.<br />
</p>
<p>
Please <a href="http://getcu3er.com/account/login">login</a> to your CU3ER account and download CU3ER package. Find XML configuration file in extracted package where paths to the existing images and instructions (settings) necessary for handling them are defined. By further altering XML node and attribute values you will configure CU3ER to match your needs. Learn more about <a href="http://docs.getcu3er.com/xml/">available XML nodes and attributes.</a>
</p>
</li>
<li>
<h4>Export project from cManager to your hard drive</h4>
<p>
Once you are satisfied with your CU3ER buildout in cManager, you can export project
.zip file with all related files. <a href="http://docs.getcu3er.com/cmanager/preview-and-export" target="_blank">How
to export CU3ER project</a>
</p>

</li>
<li>
	<h4>Import project .zip or .xml to wpCU3ER</h4>
	<p>
	You can add (import) as many CU3ER projects as you like and each one is processed
	through '<a href="admin.php?page=CU3ERAddNew">Add
	New</a>' page. For more info about importing CU3ER project please check <a href="http://docs.getcu3er.com/wpcu3er/add-new" target="_blank">related
	documentation</a>.
	</p>
</li>
<li>
	<h4>Manage slide &amp; transition settings</h4>
	<p>
	This step is optional and only required if you didn&rsquo;t made these settings
	while you were creating CU3ER or you were not using cManager to create your
	slideshow. However feel free to check your
	settings again and make fine tuning if necessarily. Learn more about <a href="http://docs.getcu3er.com/wpcu3er/edit" target="_blank">managing
	slides & transitions with wpCU3ER</a>
	</p>
</li>
<li>
	<h4>Embed CU3ER on WP page or post</h4>
	<p>
	You are now ready to insert CU3ER to WordPress page or post and this has
	 never been easier. Check out how to  <a href="http://docs.getcu3er.com/wpcu3er/embed" target="_blank">embed
	CU3ER in posts</a>.
	</p>
</li>
<li>
	<h4>Publish & enjoy</h4>
	<p>
	... and don't forget to let us know about what you have created &mdash; we would
	definitely love to know. <a href="http://getcu3er.com/contact" target="_blank">Write to
	us</a>.
	</p>
</li>
</ol>



	
	
	</div>
</div>
	<br class="clear"/>
</div>

<div class="postbox-container" style="width:24%">

<?php if($news != ''): ?>

<?php echo $news; ?>

<?php endif; ?>

<div class="postbox">
<div title="Click to toggle" class="handlediv"><br></div>
<h3 class="hndle"><span>About CU3ER</span></h3>
<div class="inside">
<p >
<a href="http://getcu3er.com"><img src="../wp-content/plugins/wpcu3er/img/logo_cu3er_site.png" alt="CU3ER - 3D image slider!" width="46" height="51" border="0" style="float:left; margin-right:15px;" /></a>CU3ER
is the 3D image slider, EASY to set up, fully CUSTOMIZABLE, TAILORED to provide
a UNIQUE look & feel, INSPIRING and FUN-to-USE. Play with CU3ER! Its
3D magic is awesome.
 </p>
 <p>
 CU3ER is equipped with a <strong><a href="http://getcu3er.com/features/">great range
 of features</a></strong> that enhance the
 user&rsquo;s experience of viewing slides. They can be grouped together as <a href="http://getcu3er.com/features/slides-and-transitions" target="_blank"><strong>Transitions</strong></a>, <a href="http://getcu3er.com/features/3d-world" target="_blank"><strong>3D
 visual enhancements</strong></a>, <a href="http://getcu3er.com/features/ui-and-indicators" target="_blank"><strong>User
 Interface &amp; Indicators</strong></a> and <a href="http://getcu3er.com/features/projects" target="_blank">lots</a> of
 other available options offer in-depth visual and playback customization which
 all together make CU3ER amazing content sliding solution.&nbsp;
	</p>
	<p>Take a look at <a href="http://getcu3er.com" target="_blank">couple of <strong>CU3ER samples</strong></a> or <a href="http://getcu3er.com/#signup">create
	<strong>CU3ER account</strong></a>.
	</p>
 <p>
 CU3ER PRO brings you following benefits:
 </p>
	<ul  class="bullets">
		<li>Brand removing</li>
		<li><a href="http://support.getcu3er.com/entries/297030-custom-cu3er-preloader-since-you-ve-asked">Custom CU3ER preloader</a></li>
		<li>Create up to 50 CU3ER <a href="http://getcu3er.com/features/projects">projects</a> via your account</li>
		<li>Up to 100 MB storage for your images</li>
		<li>Official CU3ER support via tickets</li>
	</ul>
	<p style="margin: 20px 0 30px 10px;">
		<a href="http://getcu3er.com/signup" class="button-primary">Get CU3ER</a>
		<a href="http://getcu3er.com/features" class="button">Learn more</a>
	</p>
</div>
</div>
</div>
</div>
