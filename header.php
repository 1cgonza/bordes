<?php 
$participants = getParticipants();

?><!DOCTYPE html>
<!--[if lte IE 11]><html <?php language_attributes(); ?> class="no-js lte-ie11"> <![endif]-->
<!--[if gte IE 11]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="cleartype" content="on">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="siteHeader"><?php bloginfo('name'); ?></header>
  <nav class="homeNav m-100 t-20 d-20 ld-10">
    <ul>
      <?php wp_nav_menu(array(
        'theme_location' => 'home',
        'container' => false,
        'items_wrap' => '%3$s'
      )); ?>
    </ul>
  </nav>
  <!-- <div class="participantsMenu"><?php //echo $participants; ?></div> -->
  <main class="siteMain m-100 t-80 d-80 ld-90" role="main">
  