<?php

/**
 * Template Name: Page avec bannière
 * Template Post Type: page, post
 */
?>

<?php get_template_part('parts/header') ?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <p>Ici la bannière</p>
        <h1><?= the_title(); ?></h1>
        <p>
            <img src="<?= the_post_thumbnail_url() ?>" alt="" style="width:100%; height:auto;">
        </p>
        <?= the_content(); ?>
<?php endwhile;
endif; ?>

<?php get_template_part('parts/footer') ?>