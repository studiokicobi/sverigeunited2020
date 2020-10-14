<?php get_header(); ?>

<div class="hero-container">
	<div class="hero-full-bleed full-bleed dark">
		<div class="hero wrapper">
			<h1 class="hero__heading">Sökresultat</h1>
		</div>
	</div>
</div>

<main>
	<section>

		<div class="search-result-grid">

			<div class="search-result-grid__header">
				<h1><?php
					// %s 
					echo sprintf(__('Sök resultat för: ', 'theme_base'), $wp_query->found_posts);
					echo '<br />';
					echo '<span>”' . get_search_query() . '”</span>'; ?>
				</h1>
			</div>

			<div class="search-result-grid__content">
				<?php get_template_part('template-parts/search-loop');
				?>
			</div>

		</div>

		<?php get_template_part('template-parts/pagination'); ?>

	</section>
</main>

<?php get_footer(); ?>