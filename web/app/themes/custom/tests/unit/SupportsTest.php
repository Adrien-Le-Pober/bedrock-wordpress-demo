<?php

namespace App\Tests\Unit;

use Brain\Monkey;
use App\Tests\WP_UnitTestCase;

require_once dirname(__DIR__) . '/functions.php';

class SupportsTest extends WP_UnitTestCase
{
    public function testSupports()
    {
        // Simulation des fonctions WordPress pour les tests
        Monkey\Functions\expect('add_theme_support')
            ->once()
            ->with('post-thumbnails');
        Monkey\Functions\expect('add_theme_support')
            ->once()
            ->with('menus');
        Monkey\Functions\expect('add_theme_support')
            ->once()
            ->with('html5');
        Monkey\Functions\expect('register_nav_menu')
            ->once()
            ->with('header', 'En tête du menu');
        Monkey\Functions\expect('add_image_size')
            ->once()
            ->with('card-header', 350, 215, true);

        // Appeler la fonction supports() pour tester
        supports();

        $this->assertTrue(true, 'Les attentes de Brain Monkey n\'ont pas été remplies.');
    }
}
