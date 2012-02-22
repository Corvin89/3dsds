<?php get_header(); ?>

<div id="slider" class="slider3d">

    <?php query_posts('post_type=portfolio&orderby=rand&showposts='.get_option('Slide-show').'&portfolio-category=slider'); ?>
    <?php while (have_posts()) : the_post(); ?>
    <a href="<?php the_permalink();?>"><img src="<?php bloginfo('url') ?>/thumb.php?src=<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>&#38;h=1200&#38;w=800&#38;zc=1" alt="" /></a>
<!--    <img src="--><?php //bloginfo('url') ?><!--/thumb.php?=--><?//= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?><!--&#38;w=561&#38;zc=1" alt="" />-->
<!--        <a href="--><?php //the_permalink();?><!--">--><?php //the_thumb(750); ?><!--</a>-->
    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
    
</div>

<div id="our-works">
    <div id="our-works-header">Our <span class="yellow">works</span></div>
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
                        href="<?php the_permalink();?>portfolio/?portfolio-category=<?php echo $term->slug; ?>">
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

<div id="content">
    <table class="blog-bottom">

        <tr>
            <td valign="top">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>

                        <td valign="top" width="33%" class="article_column">

                            <table class="contentpaneopen-bottom">


                                <tr>
                                    <td valign="top" colspan="2">

                                        <?php
                                        $slug = 'outsource-development';
                                        $page = get_page_by_path('outsource-development');
                                        echo '<div class="bottom-title"><a class="yellow" href="' . get_page_link('$page') . '">';
                                        echo $page->post_title;
                                        echo '</a></div>';
                                        echo '<div class="entry">';
                                        echo $page->post_content;
                                        echo '</div>';
                                        ?>
                                    </td>
                                </tr>


                            </table>
                            <span class="article_separator">&nbsp;</span>
                        </td>
                        <td valign="top" width="33%" class="article_column column_separator">

                            <table class="contentpaneopen-bottom">


                                <tr>
                                    <td valign="top" colspan="2">
                                        <?php
                                        $slug = 'why-choose-us';
                                        $page = get_page_by_path('why-choose-us');
                                        echo '<div class="bottom-title"><a class="yellow" href="' . get_page_link('$page') . '">';
                                        echo $page->post_title;
                                        echo '</a></div>';
                                        echo '<div class="entry">';
                                        echo $page->post_content;
                                        echo '</div>';
                                        ?>

                                    </td>
                                </tr>


                            </table>
                            <span class="article_separator">&nbsp;</span>

                        </td>
                        <td valign="top" width="33%" class="article_column column_separator">

                            <table class="contentpaneopen-bottom">


                                <tr>
                                    <td valign="top" colspan="2">
                                        <?php
                                        $slug = 'words';
                                        $page = get_page_by_path('words');
                                        echo '<div class="bottom-title"><a class="yellow" href="' . get_page_link('$page') . '">';
                                        echo $page->post_title;
                                        echo '</a></div>';
                                        echo '<div class="entry">';
                                        echo $page->post_content;
                                        echo '</div>';
                                        ?>

                                    </td>
                                </tr>


                            </table>
                            <span class="article_separator">&nbsp;</span>
                        </td>
                        
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
<div class="simpleForm">	
<?php echo do_shortcode('[contact-form-7 id="75" title="Contact"]') ?>

</div>
    <div style="clear:both"></div>


<?php get_footer(); ?>
