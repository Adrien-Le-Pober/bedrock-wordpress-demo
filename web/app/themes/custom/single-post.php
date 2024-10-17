<?php get_header() ?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <h1><?= the_title(); ?></h1>

        <?php if(get_post_meta(get_the_ID(), App\Metaboxes\SponsoMetaBox::META_KEY, true) === "1"): ?>
            <div class="alert alert-info">
                Cet article est sponsorisé
            </div>
        <?php endif ?>
        <p>
            <img src="<?= the_post_thumbnail_url()?>" alt="" style="width:100%; height:auto;">
        </p>
        <?= the_content(); ?>
<?php endwhile;
endif; ?>

<?php get_footer() ?>