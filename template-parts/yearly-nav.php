<nav class="nyheter__yearly-nav">
    <ul>
        <?php

        // Get the URL segments
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        // Get the second segment if it exists. This is the category slug. 
        $slug = $uriSegments[2];
        // Get the category from the slug
        $cat = get_category_by_slug($slug);
        // $catID is the ID we need for the archive array below
        $catID = $cat->term_id;

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