<?php get_header(); ?>
<div id="content-internal">
    <div id="content-internal-header">
        <div id="content-internal-header-title">Contacts</div>
        <div style="clear:both"></div>
    </div>
    <div id="content-internal-center">
        <div class="contacts">
			<div class="name"><span class="yellow">Name</span><?php $name=get_post_meta($post->ID,'name'); echo $name[0];?></div>
			<div class="job"><span class="yellow">Job</span><?php $job=get_post_meta($post->ID,'job'); echo $job[0];?></div>
            <div class="phone"><span class="yellow">Phone</span><?php $phone=get_post_meta($post->ID,'Telephone'); echo $phone[0];?></div>
<div class="email"><span class="yellow">Email</span><?php $email=get_post_meta($post->ID,'Email'); echo $email[0]; ?></div>            
<div class="skype"><span class="yellow">Skype</span><?php $skype=get_post_meta($post->ID,'Skype'); echo $skype[0];?></div>
            
            <div style="clear:both;"></div>
        </div>
		<div class="contacts">
			<div class="phone2"><?php $name=get_post_meta($post->ID,'name'); echo $name[1];?></div>
			<div class="phone2"><?php $job=get_post_meta($post->ID,'job'); echo $job[1];?></div>
            <div class="phone2"><?php $phone=get_post_meta($post->ID,'Telephone'); echo $phone[1];?></div>
            <div class="email2"><?php $email=get_post_meta($post->ID,'Email'); echo $email[1]; ?></div>
            <div class="skype2"><?php $skype=get_post_meta($post->ID,'Skype'); echo $skype[1];?></div>
            <div style="clear:both;"></div>
        </div>
        <?php echo do_shortcode('[contact-form-7 id="75" title="Contact"]') ?>
        <div style="clear:both;">
        </div>
    </div>
</div>

<?php get_footer(); ?>


