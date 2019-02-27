<?php get_header();

if (is_home()) {
  get_template_part('parts/single', 'home');
} else {
  if (have_posts()) :
    while (have_posts()) :
      the_post();
      get_template_part('parts/content', get_post_type());
    endwhile;
  else :
    get_template_part('parts/posts', 'none');
  endif;
}

get_footer();
