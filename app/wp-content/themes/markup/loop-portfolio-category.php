<div id="our-works">
    <div id="our-works-header"><span class="yellow">Portfolio</span></div>
    <div id="our-works-center">
        <ul id="mainlevel">

            <?php
            $terms = get_terms("portfolio-category", "orderby=id&order=ASC");
            $count = count($terms);
            if ($count > 0) {
                foreach ($terms as $term)
                if($term->slug!='slider'){
                    ?>

                    <li><a
                        href="<?php the_permalink();?>/?portfolio-category=<?php echo $term->slug; ?>">
                    <?php query_posts('post_type=portfolio&portfolio-category=' . $term->slug . '&posts_per_page=1&orderby=date&order=ASC'); ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_post_thumbnail(array(295, 172)); ?>
                        <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                    <?php echo "<span>" . $term->name . "</span></a></li>";
                }
            }?>

        </ul>
        <div style="clear:both;"></div>
    </div>
</div>