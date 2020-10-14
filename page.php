<?php
// If this is Om Stiftelsen, redirect to the subpage Om oss
if (is_page(7)) {
	nocache_headers();
	wp_redirect(get_permalink(273));
}
?>

<?php get_header(); ?>

<main>
	<section>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_content(); ?>

					<br class="clear">

				</article>

			<?php endwhile; ?>

		<?php else : ?>

			<article>

				<h2>Inga resultat.</h2>

			</article>

		<?php endif; ?>

	</section>
</main>

<?php get_footer(); ?>