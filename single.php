<?php get_header(); ?>

<main role="main">
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
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail(); // Fullsize image for the single post 
							?>
						</a>
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