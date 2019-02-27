<?php

function custom_post_types() {
  register_post_type(
    'participants',
    array(
      'labels' => array(
        'name' => 'Participants',
        'singular_name' => 'Participant',
        'all_items' => 'All participants',
        'add_new' => 'New participant',
        'add_new_item' => 'Add new participant',
        'edit' => 'Edit participant',
        'edit_item' => 'Edit participants',
        'new_item' => 'New participant',
        'view_item' => 'View page',
        'search_items' => 'Search participants',
        'parent_item_colon' => ''
      ),
      'description' => 'Project participants',
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8,
      'menu_icon' => 'dashicons-universal-access',
      'rewrite' => array('slug' => 'participantes', 'with_front' => false),
      'has_archive' => 'participantes',
      'capability_type' => 'post',
      'hierarchical' => false,
      'show_in_rest' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'revisions')
    )
  );
}

add_action('init', 'custom_post_types');
