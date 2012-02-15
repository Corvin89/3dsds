<?php
//add_action('init', 'custom_post_types_clients');

function custom_post_types_clients()
{
    
  $eventlabels = array(
    'name' => 'Clients',
    'singular_name' => 'Clients',
    'add_new' => 'Add Client',
    'add_new_item' => 'Add Client',
    'edit_item' => 'Add New Client',
    'new_item' => 'New Client',
    'view_item' => 'View Client',
    'search_items' => 'Search Clients',
    'not_found' =>  'No Clients Found',
    'not_found_in_trash' => 'No Clients Found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Clients'

  );
  $eventargs = array(
    'labels' => $eventlabels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title',  'thumbnail'));

  register_post_type('clients',$eventargs);
}

