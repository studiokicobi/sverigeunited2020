<nav class="nyheter__yearly-nav">
    <ul>
        <?php

        // Get the URL segments
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        // Get the second segment if it exists. This is the category slug. 
        $slug = $uriSegments[2];
        // Get the category from the slug
        $cat = get_category_by_slug($slug);

        // Get the current URL
        $currentUrl = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        // Get the query from the retrieved value
        $query_cat = parse_url($currentUrl, PHP_URL_QUERY);

        // Sort the categories 
        if ($query_cat == 'cat=21') {
            $cat_alt = '21';
        } elseif ($query_cat == 'cat=22') {
            $cat_alt = '22';
        } elseif ($query_cat == 'cat=10') {
            $cat_alt = '10';
        } else {
            // nada
        }

        // $catID is the ID we need for the archive array below
        if ($cat) {
            $catID = $cat->term_id;
        } else {
            // And $cat_alt is the category pulled from the query string – in the cases where it's not named in the second segment.
            $catID = $cat_alt;
        }

        // The cat arg depends on the "Add category to archive" code found in functions.php
        $args = array(
            'type'            => 'yearly',
            'limit'           => '',
            'format'          => 'custom',
            'before'          => '<li>',
            'after'           => '</li>',
            'show_post_count' => false,
            'echo'            => 1,
            'order'           => 'DESC',
            'cat'             => $catID
        );
        wp_get_archives($args);
        ?>
    </ul>
</nav>