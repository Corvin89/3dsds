<?php get_header(); ?>
<div id="content-internal">
    <div id="content-internal-center">
        <div id="right-top">
        </div>
    <div id="flexicontent" class="flexicontent item16 type2" style="padding-bottom:10px">

    <div id="content-internal-header">
    <div id="content-internal-header-title">
        <?php while (have_posts()) : the_post(); ?>
        <?php $term = wp_get_object_terms( $post->ID, 'portfolio-category'); ?>
        <h2 class="contentheading flexicontent">
            <?php the_title(); ?></h2>
</div>
        <div style="clear:both"></div>
	</div>

<div class="topblock">
    <div class="image">
        <?php
            $youtube = false;
            $vimeo = false;
            if($url = get_post_meta($post->ID, "Youtube", true)) {
                preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $youtube);
            } elseif($url = get_post_meta($post->ID, "Vimeo", true)) {
                preg_match('%http:\/\/(www.vimeo|vimeo)\.com(\/|\/clip:)(\d+)(.*?)%i', $url, $vimeo);
            }
    if (!empty($youtube)) { ?>
        <iframe width="853" height="480" src="http://www.youtube.com/embed/<?php echo $youtube[1]; ?>?autoplay=1" frameborder="0"
                allowfullscreen></iframe> <?php
    } elseif($vimeo) { ?>
        <iframe src="http://player.vimeo.com/video/<?php echo $vimeo[3]; ?>?portrait=0&amp;autoplay=1" width="853" height="480" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    <?php } else {
?>
<img src="http://denissopovstudio.com/thumb.php?zc=0&w=750&src=<?php $image=get_post_meta($post->ID,'Picture',true); echo $image; ?>">

<?php
    }?>
        <div class="clear"></div>
    </div>
</div>

        <?php if($option = get_post_meta($post->ID, "Technologies", true)): ?>
        <div class="contentpaneopen-portfolio-inherit-page">
            <p class="yellow">Technologies</p>
            <p><?php echo $option ?></p>
        </div>
        <?php endif; ?>

        <?php if($option = get_post_meta($post->ID, "Clients", true)): ?>
        <div class="contentpaneopen-portfolio-inherit-page">
            <p class="yellow">Client</p>
            <p><?php echo $option ?></p>
        </div>
        <?php endif; ?>

        <?php if($option = get_post_meta($post->ID, "Description", true)): ?>
        <div class="contentpaneopen-portfolio-inherit-page">
            <p class="yellow">Description</p>
            <p><?php echo $option ?></p>
        </div>
        <?php endif; ?>

</div>
         <?php endwhile; ?>
        <div style="clear:both;">
        </div>
    </div>
</div>


<div id="content-internal">
    <div id="content-internal-header">
        <div id="content-internal-header-title">Other works in this category</div>
        <div style="clear:both"></div>
    </div>
    <div id="content-internal-center">
        <ul id="mainlevel">

            <?php 
            query_posts('post__not_in[]='.$post->ID.'&post_type=portfolio&orderby=rand&posts_per_page=3&portfolio-category='.$term[0]->slug); ?>

            <?php while (have_posts()) : the_post(); ?>
            <li><a href="<?php the_permalink() ?>" class="mainlevel">
                <?php the_post_thumbnail(array(295, 172)); ?>
                <span><?php the_title(); ?></span></a></li>

            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </ul>

        <!-- / featured post -->

        <div style="clear:both;"></div>
    </div>
</div>
<?php get_footer(); ?>
