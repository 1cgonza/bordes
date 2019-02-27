<?php
$prefix = 'bordes_';
$tags = array();

// The Query
$the_query = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => -1
));

while ($the_query->have_posts()) {
  $the_query->the_post();
  $postTags = get_the_tags();

  if (!empty($postTags)) {
    foreach ($postTags as $obj) {
      if (!array_key_exists($obj->name, $tags)) {
        $tags[$obj->name] = [];
      }

      $tags[$obj->name][] = array(
        'title' => $post->post_title,
        'slug' => $post->post_name,
        'url' => get_permalink(),
        'img' => get_the_post_thumbnail_url()
      );
    }
  }
}
wp_reset_postdata();

foreach ($tags as $name => $data) : ?>
  <span
    class="tag"
    data-posts="<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8'); ?>"
  ><?php echo $name; ?></span>
<?php endforeach; ?>
<canvas id="stage"></canvas>
<div id="info"></div>
