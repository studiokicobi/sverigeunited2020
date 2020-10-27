<div class="grid-kort-wrapper">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="grid-kort">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php
					if (in_category('media')) {

						// Media category post

						$url = get_field('url');

					?>

						<h2>
							<a href="<?php echo $url; ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
						</h2>

						<span class="date"><?php the_time('j F Y'); ?></span>

						<?php

					} else {

						// All other category posts

						if (has_post_thumbnail()) : // Check if thumbnail exists 
						?>
							<a class="nyheter__thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail(array(500, 500));
								?>
							</a>
						<?php endif; ?>

						<h2>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h2>

						<span class="date"><?php the_time('j F Y'); ?></span>

					<?php theme_base_wp_excerpt('theme_base_wp_index'); // Build custom callback length in functions.php 
					}
					?>

				</article>
			</div>
		<?php endwhile; ?>
</div>

<?php else : ?>

	<article>
		<h2>Inga resultat.</h2>
	</article>

<?php endif; ?>