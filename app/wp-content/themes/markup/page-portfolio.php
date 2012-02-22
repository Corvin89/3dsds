<?php get_header(); ?>
<?php if (!empty($_GET["portfolio-category"])) {
    $category = $_GET["portfolio-category"];
      require_once (TEMPLATEPATH . '/loop-portfolio.php');
} else {
    require_once (TEMPLATEPATH . '/loop-portfolio-category.php');
}
?>




<?php get_footer(); ?>
