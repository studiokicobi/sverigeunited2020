<?php
// get the page ID in order to connect ACF fields
$page = 23;
?>

<div class="hero-container">
    <div class="hero-full-bleed full-bleed dark">
        <div class="hero wrapper">
            <h1 class="hero__heading"><?php the_field('rubrik', $page); ?></h1>
            <p class="hero__text"><?php the_field('beskrivning', $page); ?></p>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/category-nav'); ?>

<div class="nyheter-grid">
    <div>
        <?php get_template_part('template-parts/yearly-nav'); ?>
    </div>
    <div>
        <?php get_template_part('template-parts/loop'); ?>
    </div>
</div>

<?php get_template_part('template-parts/pagination'); ?>