<?php

/**
 * Block template file: blocks/text-grupp
 *
 * Text Grupp Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text-grupp-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-text-grupp';
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

    <?php if (have_rows('text_grupp')) : ?>
        <div class="text-grupp storlek-<?php the_field('storlek'); ?>">

            <?php while (have_rows('text_grupp')) : the_row(); ?>
                <div class="text-grupp__col-1">
                    <h2><?php the_sub_field('rubrik'); ?></h2>
                </div>
                <div class="text-grupp__col-2">
                    <?php the_sub_field('brodtext'); ?>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <?php // no rows found 
            ?>
        </div>
    <?php endif; ?>

</div>