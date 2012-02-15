<?php get_header(); ?>
<div id="content-internal">
    <div id="content-internal-header">
        <div id="content-internal-header-title">Contacts</div>
        <div style="clear:both"></div>
    </div>
    <div id="content-internal-center">
        <div class="contacts">
            <div class="icq"><span class="yellow">ICQ</span><?php echo get_option('ICQ');?></div>
            <div class="skype"><span class="yellow">Skype</span><?php echo get_option('Skype');?></div>
            <div class="email"><span class="yellow">Email</span><?php echo  get_option('Email'); ?></div>
            <div style="clear:both;"></div>
        </div>
        <?php echo do_shortcode('[contact-form-7 id="75" title="Contact"]') ?>
        <div style="clear:both;">
        </div>
    </div>
</div>

<?php get_footer(); ?>


