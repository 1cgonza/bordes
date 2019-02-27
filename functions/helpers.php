<?php

function getRelatedPosts($post) {
  $tags = wp_get_post_tags($post->ID);
  $ret = '';

  if ($tags) {
    $tag_ids = array();
    foreach ($tags as $individual_tag) {
      $tag_ids[] = $individual_tag->term_id;
    }
    $args = array(
      'tag__in' => $tag_ids,
      'post__not_in' => array($post->ID),
      'posts_per_page' => -1
    );
    $my_query = new wp_query($args);

    if ($my_query->have_posts()) {
      $ret .= '<h3>Relacionados</h3><ul>';

      while ($my_query->have_posts()) {
        $my_query->the_post();

        $ret .= '<li>';
        $ret .= '<div class="relatedcontent">';
        $ret .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">' . get_the_title() . '</a>';
        $ret .= '</div>';
        $ret .= '</li>';
      }
      $ret .= '</ul>';
    }
  }
  return $ret;
}
