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
    $q = new WP_Query($args);

    if ($q->have_posts()) {
      $ret .= '<h3>Relacionados</h3><ul>';

      while ($q->have_posts()) {
        $q->the_post();

        $ret .= '<li>';
        $ret .= '<div class="relatedcontent">';
        $ret .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">' . get_the_title() . '</a>';
        $ret .= '</div>';
        $ret .= '</li>';
      }
      wp_reset_postdata();
      $ret .= '</ul>';
    }
  }
  return $ret;
}

function getParticipants() {
  $ret = '';
  $args = array(
    'post_type' => 'participants',
    'posts_per_page' => -1,
    'orderby' => 'title',
	  'order' => 'ASC',
  );
  $q = new WP_Query($args);

  if ($q->have_posts()) {
    $ret .= '<ul>';

    while ($q->have_posts()) {
      $q->the_post();

      $ret .= '<li>';
      $ret .= '<span class="participantImg">' . get_the_post_thumbnail($q->post->ID, 'thumbnail') . '</span>';
      $ret .= '<span class="participantName">' . get_the_title() . '</span>';
      $ret .= '</li>';
    }
    wp_reset_postdata();

    $ret .= '</ul>';
  }

  return $ret;
}
