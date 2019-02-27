<?php
$prefix = 'bordes_';
$video = get_post_meta($post->ID, $prefix . 'embed', true);
$participantIds = get_post_meta($post->ID, $prefix . 'participant', true);
$participant = !empty($participantIds) ? get_post($participantIds[0]) : null;
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
  <section id="content" class="postSection">
    <h1 class="participantName"><?php echo $participant->post_title; ?></h1>
    <div class="participantBio">
      <?php echo wpautop($participant->post_content); ?>
    </div>
  </section>
  <?php endif ?>
  <section id="related" class="postSection">
    <?php echo getRelatedPosts($post); ?>
  </section>
</article>
