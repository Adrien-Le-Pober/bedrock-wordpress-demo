<?php

use App\Metaboxes\SponsoMetaBox;

get_template_part('parts/header') ?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <h1><?= the_title(); ?></h1>

        <?php if (get_post_meta(get_the_ID(), App\Metaboxes\SponsoMetaBox::META_KEY, true) === "1"): ?>
            <div class="alert alert-info">
                Cet article est sponsorisé
            </div>
        <?php endif ?>
        <p>
            <img src="<?= the_post_thumbnail_url() ?>" alt="" style="width:100%; height:auto;">
        </p>
        <?= the_content(); ?>

        <h2>Articles relatifs</h2>

        <div class="row">
            <?php
            $sports = array_map(function($term) {
                return $term->term_id;
            }, get_the_terms(get_post(), 'sport'));
            $query = new WP_Query([
                'post__not_in' => [get_the_ID()], // article à exclure
                'post_type' => 'post', // récupérer seulement les articles
                'posts_per_page' => 3,
                'orderby' => 'rand', // random
                'tax_query' => [
                    [
                        'taxonomy' => 'sport',
                        'terms' => $sports
                    ]
                ],
                'meta_query' => [
                    [
                        'key' => SponsoMetaBox::META_KEY,
                        'compare' => 'NOT EXISTS'
                    ]
                ]
            ]);
            while ($query->have_posts()) : $query->the_post();
                get_template_part('parts/card', 'post');
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    <?php endwhile;
endif; ?>

<?php get_template_part('parts/footer') ?>