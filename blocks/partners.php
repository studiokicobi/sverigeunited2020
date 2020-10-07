<?php

/**
 * Block template file: blocks/partners.php
 *
 * Partners Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'partners-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-partners';
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

<div id="<?php echo esc_attr($id); ?>" class="partners <?php echo esc_attr($classes); ?>">

    <?php if (have_rows('partners_kort')) : ?>
        <div>
            <?php while (have_rows('partners_kort')) : the_row(); ?>
                <?php if (get_sub_field('logotyp')) : ?>
                    <div>
                        <img src="<?php the_sub_field('logotyp'); ?>" />
                    </div>
                <?php endif ?>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <?php // no rows found 
        ?>
    <?php endif; ?>
</div>