<article id="post-<?php the_ID(); ?>" <?php post_class("cell"); ?>>
	<header class="pageHeader">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="pageContent">
		<?php	the_content(); ?>
	</div>

</article>
