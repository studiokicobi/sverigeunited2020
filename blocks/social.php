<?php

/**
 * Block template file: blocks/social.php
 *
 * Social Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'social-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-social';
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

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <?php if (have_rows('social_konto')) : ?>
        <?php while (have_rows('social_konto')) : the_row(); ?>
            <?php the_sub_field('kontotyp'); ?>
            <?php the_sub_field('rubrik'); ?>
            <?php the_sub_field('kortkod'); ?>
        <?php endwhile; ?>
    <?php else : ?>
        <?php // no rows found 
        ?>
    <?php endif; ?>
</div>