<?php get_header() ?>

<?php $sports = get_terms(['taxonomy' => 'sport']); ?>
<ul class="nav nav-pills my-4">
    <?php foreach($sports as $sport): ?>
    <li class="nav-item">
        <a href="<?= get_term_link($sport) ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>"><?= $sport->name ?></a>
    </li>
    <?php endforeach; ?>
</ul>

<?php if (have_posts()): ?>
    <div class="row">
        <?php while (have_posts()): the_post(); ?>
            <div class="col-sm-4">
                <div class="card">
                    <?php the_post_thumbnail('card-header', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto']) ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= the_title() ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= the_category() ?></h6>
                        <?php
                        the_terms(get_the_ID(), 'sport');
                        ?>
                        <p class="card-text"><?= the_excerpt() ?></p>
                        <a href="<?= the_permalink() ?>" class="card-link">Voir plus</a>
                    </div>
                </div>
            </div>
        <?php endwhile ?>
    </div>

    <?php App\pagination() ?>

<?php else: ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?>