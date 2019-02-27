<?php

if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
  require_once dirname(__FILE__) . '/cmb2/init.php';
} elseif (file_exists(dirname(__FILE__) . '/CMB2/init.php')) {
  require_once dirname(__FILE__) . '/CMB2/init.php';
}

function bordes_register_metabox() {
  $prefix = 'bordes_';

  $bordesMeta = new_cmb2_box(array(
    'id' => $prefix . 'project',
    'title' => esc_html__('Metadata', 'cmb2'),
    'object_types' => array('post'),
    'context' => 'normal',
    'priority' => 'high'
  ));

  $bordesMeta->add_field(array(
    'name' => esc_html__('oEmbed', 'cmb2'),
    'desc' => sprintf(
      esc_html__('Enter a youtube, twitter, or instagram URL. Supports services listed at %s.', 'cmb2'),
      '<a href="https://codex.wordpress.org/Embeds">codex.wordpress.org/Embeds</a>'
    ),
    'id' => $prefix . 'embed',
    'type' => 'oembed',
  ));

  $bordesMeta->add_field(array(
    'name' => 'Participant',
    'desc' => 'Drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.',
    'id' => $prefix . 'participant',
    'type' => 'custom_attached_posts',
    'column' => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
    'options' => array(
      'show_thumbnails' => true, // Show thumbnails on the left
      'filter_boxes' => true, // Show a text box for filtering the results
      'query_args' => array(
        'posts_per_page' => -1,
        'post_type' => 'participants',
      ),
    ),
  ));

  $participants = new_cmb2_box(array(
    'id' => $prefix . 'participant',
    'title' => esc_html__('Metadata', 'cmb2'),
    'object_types' => array('participants'),
    'context' => 'normal',
    'priority' => 'high',
  ));

  $participants->add_field(array(
    'name' => esc_html__('URL', 'cmb2'),
    'desc' => esc_html__('Link a sitio personal', 'cmb2'),
    'id' => $prefix . 'url',
    'type' => 'text_url',
  ));
}

add_action('cmb2_admin_init', 'bordes_register_metabox');
