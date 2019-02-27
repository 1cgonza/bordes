<?php get_header(); ?>
  <div class="postContainer">
    <?php
    if (have_posts()) :
      while (have_posts()) :
        the_post();
        get_template_part('parts/content', get_post_type());
      endwhile;
    else :
      get_template_part('parts/posts', 'none');
    endif;
    ?>
  </div>
<?php get_footer();
