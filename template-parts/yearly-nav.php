        <nav class="nyheter__yearly-nav">
            <ul>
                <?php
                $args = array(
                    'type'            => 'yearly',
                    'limit'           => '',
                    'format'          => 'custom',
                    'before'          => '<li>',
                    'after'           => '</li>',
                    'show_post_count' => false,
                    'echo'            => 1,
                    'order'           => 'DESC'
                );
                wp_get_archives($args);
                ?>
            </ul>
        </nav>