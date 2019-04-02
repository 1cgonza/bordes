<?php
$prefix = 'bordes_';
$video = get_post_meta($post->ID, $prefix . 'embed', true);
$participantIds = get_post_meta($post->ID, $prefix . 'participant', true);
$participant = !empty($participantIds) ? get_post($participantIds[0]) : null;

if ($participant) {
  $tags = array();

  // The Query
  $the_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
        'key' => 'bordes_participant',
        'value' => $participant->ID,
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
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('m-80 t-70 d-70 ld-70'); ?>>
  <div class="postLinks gridWrapper gridJustifySpaceBetween">
    <span class="postLink pevLink"><?php previous_post_link(); ?></span>
    <span class="postLink nextLink"><?php next_post_link(); ?></span>
  </div>
  
	<section id="top" class="postSection">
    <?php echo wp_oembed_get($video); ?>
  </section>

  <?php if ($participant) : ?>
  <section id="content" class="postSection m-100 t-100 d-100 ld-100">
    <div class="participantHeader gridWrapper">
    <span class="participantThumb"><?php echo get_the_post_thumbnail($participant->ID); ?></span>
      <h1 class="participantName"><?php echo $participant->post_title; ?></h1>
    </div>
    <div class="participantBio">
      <?php echo wpautop($participant->post_content); ?>
    </div>
  </section>
  <?php endif ?>
  <section id="related" class="postSection">
    <?php echo getRelatedPosts($post); ?>
  </section>
  <?php if ($participant) : ?>
  <section id="tags">
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
  </section>
  <?php endif; ?>

  <?php comments_template(); ?>
</article>
