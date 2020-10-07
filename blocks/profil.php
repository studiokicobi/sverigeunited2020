<?php

/**
 * Block template file: blocks/profil.php
 *
 * Profil Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'profil-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-profil';
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

<section id="<?php echo esc_attr($id); ?>" class="profil-wrapper <?php echo esc_attr($classes); ?>">
    <?php if (have_rows('profiler')) : ?>
        <?php while (have_rows('profiler')) : the_row(); ?>
            <div class="profil enkel-kort">
                <div class="profil-image-wrapper">
                    <?php if (get_sub_field('bild')) : ?>
                        <img class="profil-image-wrapper__image" src="<?php the_sub_field('bild'); ?>" />
                    <?php endif ?>
                </div>
                <div class="profil-text-content">
                    <h2 class="profil-text-content__name"><?php the_sub_field('namn'); ?></h2>
                    <h3 class="profil-text-content__role"><?php the_sub_field('roll'); ?></h3>
                    <p class="profil-text-content__description"><?php the_sub_field('beskrivning'); ?></p>
                </div>

                <?php if (get_sub_field('email')) : ?>
                    <div class="profil-email">
                        <a class="knapp" href="mailto:<?php esc_url(antispambot(the_sub_field('email'))); ?>">Email</a>
                    </div>
                <?php endif ?>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <?php // no rows found 
        ?>
    <?php endif; ?>
</section>