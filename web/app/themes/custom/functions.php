<?php

namespace App;

use App\Metaboxes\SponsoMetaBox;

function supports()
{
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
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

function register_sport() {
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
}

add_action('init', 'App\register_sport');
add_action('after_setup_theme', 'App\supports');
add_action('wp_enqueue_scripts', 'App\register_assets');
add_filter('nav_menu_css_class', 'App\menu_class');
add_filter('nav_menu_link_attributes', 'App\menu_link_class');

require_once('metaboxes/SponsoMetaBox.php');
SponsoMetaBox::register();