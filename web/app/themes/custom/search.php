<?php get_header() ?>

<form>
    <input type="search" class="form-control mt-2" placeholder="Votre recherche" name="s" value="<?= get_search_query() ?>">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" name="sponso" id="flexCheckDefault" <?= checked('1', get_query_var('sponso')) ?>>
        <label class="form-check-label" for="flexCheckDefault">
            Article sponsorisé seulement
        </label>
    </div>
    <button type="submit" class="btn btn-primary mb-1">Rechercher</button>
</form>

<h1 class="mb-4">Résultat pour votre recherche "<?= get_search_query() ?>"</h1>

<?php if (have_posts()): ?>
    <div class="row">
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('parts/card', 'post'); ?>
        <?php endwhile ?>
    </div>

    <?php App\pagination() ?>

<?php else: ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?>