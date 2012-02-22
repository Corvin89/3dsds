<?php
add_action('init', 'custom_posttypes');

function custom_posttypes()
{
 register_post_type('portfolio', array(	'label' => 'Portfolio','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'supports' => array('title','custom-fields','thumbnail',),'taxonomies' => array('portfolio-category',),'labels' => array (
  'name' => 'Portfolio',
  'singular_name' => 'Portfolio',
  'menu_name' => 'Portfolio',
  'add_new' => 'Add Portfolio',
  'add_new_item' => 'Add New Portfolio',
  'edit' => 'Edit',
  'edit_item' => 'Edit Portfolio',
  'new_item' => 'New Portfolio',
  'view' => 'View Portfolio',
  'view_item' => 'View Portfolio',
  'search_items' => 'Search Portfolio',
  'not_found' => 'No Portfolio Found',
  'not_found_in_trash' => 'No Portfolio Found in Trash',
  'parent' => 'Parent Portfolio',
),) );
}