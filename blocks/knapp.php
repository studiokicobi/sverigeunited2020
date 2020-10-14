<?php

/**
 * Block template file: blocks/knapp.php
 *
 * Knapp Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'knapp-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-knapp';
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

<?php $lank = get_field('lank'); ?>
<?php if ($lank) :
    $link_target = $lank['target'] ? $lank['target'] : '_self';
?>

    <a id=" <?php echo esc_attr($id); ?>" class="knapp <?php echo esc_attr($classes); ?>" href="<?php echo esc_url($lank['url']); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($lank['title']); ?></a>
<?php endif; ?>