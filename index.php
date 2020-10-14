<?php get_header(); ?>

<main>
	<section>

		<h1>Latest Posts</h1>

		<?php get_template_part('template-parts/loop'); ?>

		<?php get_template_part('template-parts/pagination'); ?>

	</section>
</main>

<?php get_footer(); ?>