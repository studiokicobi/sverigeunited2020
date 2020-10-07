<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if (has_post_thumbnail()) : // Check if thumbnail exists 
			?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(array(120, 120)); // Declare pixel size you need inside the array 
					?>
				</a>
			<?php endif; ?>

			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>

			<span class="date"><?php the_time('j F Y'); ?></span>

			<?php theme_base_wp_excerpt('theme_base_wp_index'); // Build custom callback length in functions.php 
			?>

			<?php edit_post_link(); ?>

		</article>

	<?php endwhile; ?>

<?php else : ?>

	<article>
		<h2>Inga resultat.</h2>
	</article>

<?php endif; ?>