<?php

// Front page template

get_header(); ?>

<main role="main">
	<section>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_content(); ?>

					<br class="clear">

				</article>

			<?php endwhile; ?>

		<?php endif; ?>

	</section>
</main>

<?php get_footer(); ?>