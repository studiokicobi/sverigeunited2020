<?php

/**
 * Block template file: blocks/kort.php
 *
 * Kort Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// The block uses the Every Layout Switcher CSS component.

// Create id attribute allowing for custom "anchor" value.
$id = 'kort-' . $block['id'];
if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-kort';
if (!empty($block['className'])) {
	$classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
	$classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr($id); ?>" class="grid-kort-wrapper <?php echo esc_attr($classes); ?>">
	<?php if (have_rows('kort')) : ?>

		<?php while (have_rows('kort')) : the_row(); ?>
			<div class="grid-kort">
				<?php if (get_sub_field('visa_lanken_som_en_knapp') == 1) : ?>
					<h2>
					<?php else : ?>
						<h2 class="standard-anchor">
						<?php endif; ?>

						<?php
						$lank = get_sub_field('lank');
						$link_target = $lank['target'] ? $lank['target'] : '_self';
						?>

						<a href="<?php echo esc_url($lank['url']); ?>" target="<?php echo esc_attr($link_target); ?>">
							<?php echo esc_html($lank['title']); ?>
						</a>
						</h2>

						<p>
							<?php the_sub_field('brodtext'); ?>
						</p>

						<?php if (get_sub_field('visa_lanken_som_en_knapp') == 1) : ?>
							<p>
								<a class="knapp" href="<?php echo esc_url($lank['url']); ?>" target="<?php echo esc_attr($link_target); ?>">
									<?php echo esc_html($lank['title']); ?>
								</a>
							</p>
						<?php else : ?>
							<?php // echo 'false'; 
							?>
						<?php endif; ?>
			</div>
		<?php endwhile; ?>

	<?php else : ?>
		<?php // no rows found 
		?>
	<?php endif; ?>
</div>