<div class="grid-kort-wrapper">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" class="grid-kort">

                <?php if (has_post_thumbnail()) :
                ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail();
                        ?>
                    </a>
                <?php endif; ?>

                <h2>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </h2>

                <span class="date"><?php the_time('j F Y'); ?></span>

                <?php theme_base_wp_excerpt('theme_base_search_result');
                ?>

            </article>

        <?php endwhile; ?>
    <?php else : ?>

        <article>
            <h2>Inga resultat.</h2>
        </article>

    <?php endif; ?>

</div>