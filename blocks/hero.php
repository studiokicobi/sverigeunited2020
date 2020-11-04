<?php

/**
 * Block template file: blocks-hero.php
 *
 * Bla Sidhuvud Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-hero';
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



<div id="<?php echo esc_attr($id); ?>" class="hero-container <?php echo esc_attr($classes); ?>">
    <?php if (have_rows('layout')) : ?>

        <?php while (have_rows('layout')) : the_row(); ?>
            <?php $theme = get_sub_field('theme'); ?>
        <?php endwhile; ?>

        <div class="hero-full-bleed full-bleed <?php echo $theme; ?>">
            <div class="hero wrapper">
                <?php while (have_rows('layout')) : the_row(); ?>

                    <div class="hero__content">
                        <h1 class="hero__heading"><?php the_sub_field('rubrik'); ?></h1>

                        <?php $hero_text = get_sub_field('brodtext'); ?>
                        <?php if ($hero_text) : ?>
                            <p class="hero__text"><?php the_sub_field('brodtext'); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if (have_rows('ensam_kort')) : ?>
                        <?php while (have_rows('ensam_kort')) : the_row(); ?>

                            <?php $kort_rubrik = get_sub_field('kort_rubrik'); ?>
                            <?php if ($kort_rubrik) : ?>
                                <div class="hero__kort ensam-kort">
                                    <h2 class="ensam-kort__heading"><?php the_sub_field('kort_rubrik'); ?></h2>
                                <?php endif; ?>

                                <?php $kort_text = get_sub_field('kort_rubrik'); ?>
                                <?php if ($kort_text) : ?>
                                    <p class="ensam-kort__text"><?php the_sub_field('kort_text'); ?></p>
                                <?php endif; ?>

                                <?php
                                $kort_lank = get_sub_field('kort_lank');
                                if ($kort_lank) :
                                    $link_target = $kort_lank['target'] ? $kort_lank['target'] : '_self';
                                ?>

                                    <a class="knapp ensam-kort__knapp" href="<?php echo esc_url($kort_lank['url']); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($kort_lank['title']); ?></a>
                                <?php endif; ?>

                                <?php $kort_rubrik = get_sub_field('kort_rubrik'); ?>
                                <?php if ($kort_rubrik) : ?>
                                </div>
                            <?php endif; ?>

                        <?php endwhile; ?>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
</div>