<?php

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use App\Options\AgenceMenuPage;
use App\Metaboxes\SponsoMetaBox;
use App\Widgets\YoutubeWidget;
use App\Walker\CommentWalker;

function supports()
{
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', ['comment-list', 'comment-form']);
    register_nav_menu('header', 'En tête du menu');

    add_image_size('card-header', 350, 215, true);
}

function register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', []);
    wp_register_script(handle: 'bootstrap', src: 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', deps: ['popper'], args: true);
    wp_register_script(handle: 'popper', src: 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', args: true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

function menu_class(array $classes): array
{
    $classes[] = 'nav-item';
    return $classes;
}

function menu_link_class(array $attrs): array
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages) {
        echo '<nav aria-label="Pagination" class="my-4">';
        echo "<ul class='pagination'>";

        foreach ($pages as $page) {
            $active = str_contains($page, 'current') !== false;
            $class = "page-item";
            $active && $class .= ' active';
            echo '<li class="' . $class . '">';
            echo str_replace('page-numbers', 'page-link', $page);
            echo '</li>';
        }

        echo '</ul>';
        echo '</nav>';
    }
}

function init() {
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'singular_name'     => 'Sport',
            'plural_name'       => 'Sports',
            'search_items'      => 'Rechercher des sports',
            'all_items'         => 'Tous les sports',
            'edit_item'         => 'Editer le sport',
            'update_item'       => 'Mettre à jour le sport',
            'add_new_item'      => 'Ajouter un nouveau sport',
            'new_item_name'     => 'Ajouter un nouveau sport',
            'menu_name'         => 'Sport',
        ],
        'show_in_rest' => true, // rendre la taxonomie disponible dans les options des articles
        'hierarchical' => true, // afficher des checkboxes pour selectionner les ports
        'show_admin_column' => true,
    ]);
    register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true, // activer l'éditeur visuel
        'has_archive' => true, // activer les pages d'archives pour ce type
    ]);
}

// altére la requête principale de WordPress pour créer des recherches avancées
function pre_get_posts (\WP_Query $query) {
    // annuler les filtres pour les sections suivantes
    if (is_admin() || !is_search() || !$query->is_main_query()) {
        return;
    }
    if (get_query_var('sponso') === '1') {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => SponsoMetaBox::META_KEY,
            'compare' => 'EXISTS',
        ];
        $query->set('meta_query', $meta_query);
    }
}

// autoriser des paramètres d'URL spécifiques
function query_vars ($params) {
    $params[] = 'sponso';
    return $params;
}

function register_custom_widget () {
    register_widget(YoutubeWidget::class);
    register_sidebar([
        'id' => 'homepage',
        'name' => 'Sidebar Accueil',
        // pour modifier l'affichage par défaut
        'before_widget' => '<div class="p-4 %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="font-italic">',
        'after_title' => '</h4>'
    ]);
}

if (function_exists('add_action')) {
    add_action('pre_get_posts', 'pre_get_posts');
    add_action('init', 'init');
    add_action('after_setup_theme', 'supports');
    add_action('wp_enqueue_scripts', 'register_assets');
    add_action('widgets_init', 'register_custom_widget'); 
    add_filter('nav_menu_css_class', 'menu_class');
    add_filter('nav_menu_link_attributes', 'menu_link_class');
    add_filter('query_vars', 'query_vars');
    add_filter('comment_form_fields', function($fields) {
        $fields['comment'] = <<<HTML
        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea class="form-control" name="comment" id="comment" required rows="3"></textarea>
        </div>
        HTML;
        return $fields;
    });
}

SponsoMetaBox::register();
AgenceMenuPage::register();