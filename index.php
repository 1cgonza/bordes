<?php
/**
 * Home page structure
 */
$index_page_title = get_the_title( get_option('page_for_posts', true) );
get_header();
?>
<main class="siteMain" role="main">  
  <nav class="homeNav">
    <ul>
      <?php wp_nav_menu(array(
        'theme_location' => 'home',
        'container' => false,
        'items_wrap' => '%3$s'
      )); ?>
    </ul>
  </nav>
</main>
<?php get_footer(); ?>