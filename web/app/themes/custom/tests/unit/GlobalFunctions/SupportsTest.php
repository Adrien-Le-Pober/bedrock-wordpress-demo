<?php

namespace App\Tests\Unit;

use WP_UnitTestCase;

require_once dirname(__FILE__, 4) . '/functions.php';

class SupportsTest extends WP_UnitTestCase
{
    /**
     * Met en place l'environnement de test avant chaque test.
     */
    public function setUp(): void
    {
        parent::setUp();

        // Appeler l'action pour initialiser la fonction `supports`
        supports();
    }

    /**
     * Teste si le support pour les vignettes est activé
     */
    public function testPostThumbnailsSupport()
    {
        $this->assertTrue(current_theme_supports('post-thumbnails'), true);
    }

    /**
     * Teste si le support pour les menus est activé
     */
    public function testMenusSupport()
    {
        $this->assertTrue(current_theme_supports('menus'), true);
    }

    /**
     * Teste si le support pour HTML5 est activé
     */
    public function testHtml5Support()
    {
        $this->assertTrue(current_theme_supports('html5'), true);
    }

    /**
     * Teste si le menu de navigation est bien enregistré
     */
    public function testNavMenuRegistered()
    {
        $registered_menus = get_registered_nav_menus();
        $this->assertArrayHasKey('header', $registered_menus, 'Le menu "header" devrait être enregistré.');
    }

    /**
     * Teste si la taille d'image "card-header" est bien ajoutée
     */
    public function testImageSizeAdded()
    {
        $image_sizes = wp_get_additional_image_sizes();
        $this->assertArrayHasKey('card-header', $image_sizes, 'La taille d\'image "card-header" devrait être ajoutée.');
        $this->assertEquals(350, $image_sizes['card-header']['width'], 'La largeur de "card-header" devrait être 350.');
        $this->assertEquals(215, $image_sizes['card-header']['height'], 'La hauteur de "card-header" devrait être 215.');
        $this->assertTrue($image_sizes['card-header']['crop'], 'L\'image "card-header" devrait être recadrée.');
    }
}
