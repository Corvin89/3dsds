<?php register_taxonomy('portfolio-category', array(
                                                   0 => 'portfolio',
                                              ), array('hierarchical' => true, 'label' => 'Categories', 'show_ui' => true, 'query_var' => true, 'rewrite' => array('slug' => 'Slug'), 'singular_label' => 'Category'));