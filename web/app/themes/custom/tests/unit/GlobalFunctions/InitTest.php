<?php

namespace App\Test\Unit;

use WP_UnitTestCase;

class UnitTest extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        init();
    }

    public function testSportTaxonomyRegistered()
    {
        $taxonomy = get_taxonomy('sport');
        $this->assertNotNull($taxonomy, 'La taxonomie "sport" devrait être enregistrée.');

        // Vérifie les labels
        $this->assertEquals('Sport', $taxonomy->labels->name);
        $this->assertEquals('Sport', $taxonomy->labels->singular_name);
        $this->assertEquals('Sports', $taxonomy->labels->plural_name);
        $this->assertEquals('Rechercher des sports', $taxonomy->labels->search_items);
        $this->assertEquals('Tous les sports', $taxonomy->labels->all_items);
        $this->assertEquals('Editer le sport', $taxonomy->labels->edit_item);
        $this->assertEquals('Mettre à jour le sport', $taxonomy->labels->update_item);
        $this->assertEquals('Ajouter un nouveau sport', $taxonomy->labels->add_new_item);
        $this->assertEquals('Ajouter un nouveau sport', $taxonomy->labels->new_item_name);
        $this->assertEquals('Sport', $taxonomy->labels->menu_name);

        // Vérifie les paramètres
        $this->assertTrue($taxonomy->show_in_rest, true);
        $this->assertTrue($taxonomy->hierarchical, true);
        $this->assertTrue($taxonomy->show_admin_column, true);
    }

    public function testBienPostTypeRegistered()
    {
        $post_type = get_post_type_object('bien');
        $this->assertNotNull($post_type, 'Le type de contenu "bien" devrait être enregistré.');

        // Vérifie labels et options
        $this->assertEquals('Bien', $post_type->label);
        $this->assertTrue($post_type->public, true);
        $this->assertEquals($post_type->menu_position, 3);
        $this->assertEquals('dashicons-building', $post_type->menu_icon);
        $this->assertTrue($post_type->show_in_rest, true);
        $this->assertTrue($post_type->has_archive, true);

        // Vérifie les supports
        $this->assertTrue(post_type_supports('bien', 'title'), true);
        $this->assertTrue(post_type_supports('bien', 'editor'), true);
        $this->assertTrue(post_type_supports('bien', 'thumbnail'), true);
    }
}
