<?php
// Get the ID of the categories we want to link
$cat_id_artiklar = get_cat_ID('Artiklar');
$cat_id_video = get_cat_ID('Video');
$cat_id_media = get_cat_ID('Media');

// Get the category URLs
$cat_link_artiklar = get_category_link($cat_id_artiklar);
$cat_link_video = get_category_link($cat_id_video);
$cat_link_media = get_category_link($cat_id_media);

// Add a .current class based on the current category
if (is_category('Artiklar')) {
    $link_artiklar = 'current';
} elseif (is_category('Video')) {
    $link_video = 'current';
} elseif (is_category('Media')) {
    $link_media = 'current';
} else {
    $link_nyheter = 'current';
}
?>

<nav class="nyheter__category-nav">
    <ul>
        <!-- Get Nyheter link by title -->
        <li><a class="<?php echo $link_nyheter; ?>" href="<?php echo esc_url(get_permalink(get_page_by_title('Nyheter'))); ?>"><?php esc_html_e('Alla', 'theme_base'); ?></a></li>
        <!-- Print a category links -->
        <li><a class="<?php echo $link_artiklar; ?>" href="<?php echo esc_url($cat_link_artiklar); ?>" title="Artiklar">Artiklar</a></li>
        <li><a class="<?php echo $link_video; ?>" href="<?php echo esc_url($cat_link_video); ?>" title="Video">Video</a></li>
        <li><a class="<?php echo $link_media; ?>" href="<?php echo esc_url($cat_link_media); ?>" title="Media">Media</a></li>
    </ul>
</nav>