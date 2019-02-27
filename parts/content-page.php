<article id="post-<?php the_ID(); ?>" <?php post_class('m-80 t-70 d-70 ld-50'); ?>>
	<header class="pageHeader">
		<?php the_title('<h1 class="pageTitle">', '</h1>'); ?>
	</header>

	<div class="pageContent">
		<?php	the_content(); ?>
	</div>
</article>
