<?php get_header(); ?>

<main>
	<!-- section -->
	<section class="single-content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h1>
						<?php the_title(); ?>
					</h1>

					<span class="date"><?php the_time('j F Y'); ?></span>

					<?php
					// Get the category ID and check against category 22
					$postcat = get_the_category($query->post->ID);
					if ($postcat[0]->cat_ID != '22') {
						// Not in excluded category
						if (has_post_thumbnail()) : // Check if Thumbnail exists 
							the_post_thumbnail(array('class' => 'post-thumbnail'));
						endif;
					}
					?>

					<?php the_content(); ?>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

		<?php else : ?>

			<!-- article -->
			<article>

				<h1>Inga resultat.</h1>

			</article>
			<!-- /article -->

		<?php endif; ?>

	</section>
	<!-- /section -->
</main>

<?php get_footer(); ?>