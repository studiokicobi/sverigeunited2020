<?php

/**
 * Block template file: blocks/omslag.php
 *
 * Omslag Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'omslag-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-omslag';
if (!empty($block['className'])) {
	$classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {}

	.omslag {
		background-repeat: no-repeat;
		background-size: cover;
		min-height: 15rem;
	}
</style>

<div id="<?php echo esc_attr($id); ?>" class="omslag-wrapper <?php echo esc_attr($classes); ?>">
	<?php if (have_rows('omslag')) : ?>
		<?php while (have_rows('omslag')) : the_row(); ?>

			<?php
			$lank = get_sub_field('lank');
			$link_target = $lank['target'] ? $lank['target'] : '_self';
			?>

			<!-- <div class="omslag" style="background-image: url('<?php the_sub_field('bakgrundsbild'); ?>');"> -->
			<div class="omslag" style="background-image: url('
			<?php
			$omslagBgImage = get_sub_field('bakgrundsbild');
			$omslagBgImageSize = 'medium';
			if ($omslagBgImage) {
				echo wp_get_attachment_image($omslagBgImage, $omslagBgImageSize);
			} ?>
			');">

				<?php if ($lank) : ?>
					<a class="omslag__img-link" href="<?php echo esc_url($lank['url']); ?>" target="<?php echo esc_attr($link_target); ?>">

						<div class="omslag-content">
							<h2 class="omslag-content__heading">
								<?php echo esc_html($lank['title']); ?>
							</h2>
						</div>

					</a>

				<?php endif; ?>
			</div>

		<?php endwhile; ?>
	<?php else : ?>
		<?php // no rows found 
		?>
	<?php endif; ?>
</div>