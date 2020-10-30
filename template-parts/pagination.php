<!-- pagination -->
<?php
// Get the URL segments
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Set the year according to the URL segment
$year = $uriSegments[1];

$currCat = get_category(get_query_var('cat'));
$cat_name = $currCat->name;
$cat_id   = get_cat_ID($cat_name);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();

// We have a two kinds of sorting going on here: category & year.
// Getting WordPress to limit pagination by year isn't straightforward,
// but fortunately there's a simple solution:
// get the value from the first URL segment and plug that into the query.
$wp_query->query('year=' . $year . '&post_type=post&paged=' . $paged . '&cat=' . $cat_id);

global $wp_query;

$big = 999999999;
echo '<div class="pagination">';
echo paginate_links(array(
	'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	'format' => '?paged=%#%',
	'prev_text' => __('<<'),
	'next_text' => __('>>'),
	'current' => max(1, get_query_var('paged')),
	'total' => $wp_query->max_num_pages
));
echo '</div>';
?>
<!-- /pagination -->