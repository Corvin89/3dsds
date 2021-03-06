<div id="content-internal">
    <div id="content-internal-header">
        <div id="content-internal-header-title">
            <?php if (empty($_GET["portfolio-category"])) {
            echo "Portfolio";
        } else {
            $term = get_term_by('slug', $_GET["portfolio-category"], 'portfolio-category');
            echo $term->name;
        } ?></div>
        <div style="clear:both"></div>
    </div>
    <div id="content-internal-center">
        <ul id="mainlevel">

            <?php query_posts('orderby=date&order=ASC&post_type=portfolio&portfolio-category=' . $_GET["portfolio-category"] . ''); ?>

            <?php while (have_posts()) : the_post(); ?>

            <li><a href="<?php the_permalink() ?>" class="mainlevel">
                <img src="http://denissopovstudio.com/thumb.php?zc=0&w=295&src=<?php $image=get_post_meta($post->ID,'Picture',true); echo $image; ?>">
                <span><?php the_title(); ?></span></a></li>

            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </ul>
        <div style="clear:both;"></div>
    </div>
</div>
