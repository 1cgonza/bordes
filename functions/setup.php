<?php

function bordesSetup() {
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'bordesSetup');
