<?php
$prefix = 'bordes_';
$tags = array();

// The Query
$the_query = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => -1,
  'meta_query' => array(
    array(
      'key' => 'bordes_participant',
      'value' => $post->ID,
      'compare' => 'LIKE'
    )
  )
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
        'img' => get_the_post_thumbnail_url($post->ID, 'medium')
      );
    }
  }
}
wp_reset_postdata(); 
?>

<div class="tagsWrapper">

<?php foreach ($tags as $name => $data) : ?>
  <span
    class="tag"
    data-posts="<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8'); ?>"
  ><?php echo $name; ?></span>
<?php endforeach; ?>
<canvas id="stage"></canvas>
</div>
<div id="info" class="m-50 t-50 d-40 ld-40"></div>
<section id="content" class="postSection m-90 t-90 d-80 ld-70">
  <div class="participantHeader gridWrapper">
    <span class="participantThumb"><?php the_post_thumbnail(); ?></span>
    <h1 class="participantName"><?php the_title(); ?></h1>
  </div>
  
  <div class="participantBio">
    <?php the_content(); ?>
  </div>

</section>