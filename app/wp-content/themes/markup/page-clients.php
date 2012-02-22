<?php get_header(); ?>
<div id="content-internal-no-js">
    <div id="content-internal-header">
        <div id="content-internal-header-title" style="clear:both;">Clients</div>
    </div>
    <div id="content-internal-center">
        <ul id="blog-clients">
            <?php query_posts('post_type=client')?>
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post();  ?>
                <li>
                    <a href='http://<?php echo get_post_meta($post->ID, "URL_Clients", true);?>'>
                        <h2><?php the_title();?></h2>
                        <?php the_thumb(150, 0); ?>
                        <address><?php echo get_post_meta($post->ID, "URL_Clients", true);?></address>
                    </a>
                </li>
                <?php endwhile; ?>
            <?php endif;?>
        </ul>
    </div>
</div>
<?php get_footer(); ?>