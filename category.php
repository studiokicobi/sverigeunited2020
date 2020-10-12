<?php

// Category

get_header();

// get the page ID in order to connect ACF fields
$page = 23;
// Yearly Archive shortcode
// $years = do_shortcode('[SimpleYearlyArchive exclude="1,3,5"]');

?>

<main class="nyheter">
	<section>

		<?php get_template_part('template-parts/nyheter'); ?>

	</section>
</main>

<?php get_footer(); ?>