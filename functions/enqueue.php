<?php

function bordes_google_fonts()
{
  $url = '';
  $fonts = array();
  $fonts[] = 'Petit+Formal+Script';
  $fonts[] = 'PT+Sans:400,400i,700';

  if (!empty($fonts)) {
    $url = add_query_arg('family', implode('|', $fonts), 'https://fonts.googleapis.com/css');
  }
  return $url;
}

function bordes_enqueue_scripts()
{
  // Only use this method is we're not in wp-admin
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', null, '3.2.1', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('youtubeApi', '//apis.google.com/js/api.js', array(), null, true);
    wp_enqueue_script('theme-bundle-js', get_template_directory_uri() . '/dist/main.js', array(), null, true);

    wp_enqueue_style('google-fonts', bordes_google_fonts(), array(), null);
    wp_enqueue_style('theme-bundle-css', get_template_directory_uri() . '/dist/main.css', array(), null, 'all');

    $templateUrl = array('templateUrl' => get_stylesheet_directory_uri());
    wp_localize_script('theme-bundle-js', 'basePath', $templateUrl);
  }
}
add_action('wp_enqueue_scripts', 'bordes_enqueue_scripts', 999);

function bordes_async_defer($tag, $handle)
{
  if ('youtubeApi' !== $handle) {
    return $tag;
  }

  return str_replace(' src', ' async defer onload=this.onload=function(){};handleClientLoad() onreadystatechange=if(this.readyState==="complete")this.onload() src', $tag);
}

//add_filter('script_loader_tag', 'bordes_async_defer', 10, 2);
