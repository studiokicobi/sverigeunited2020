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

					<!-- post thumbnail -->
					<?php if (has_post_thumbnail()) : // Check if Thumbnail exists 
					?>

						<?php foreach ((get_the_category()) as $cat) {
							// if (!($cat->cat_ID == '3'))
							// echo '';
							// elseif (!($cat->cat_ID == '21'))
							// echo '';
							if (($cat->cat_ID == '22')) // Don't show the post thumb if this is the Video category.
								echo '';
							else
								echo '<a href="' . the_permalink() . '" title="' . the_title() . '">' . the_post_thumbnail() . '</a>';
						} ?>

					<?php endif; ?>
					<!-- /post thumbnail -->

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