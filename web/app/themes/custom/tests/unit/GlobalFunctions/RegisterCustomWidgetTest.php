<?php

namespace App\Tests\Unit;

use WP_UnitTestCase;
use App\Widgets\YoutubeWidget;

class RegisterCustomWidgetTest extends WP_UnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Réinitialiser les widgets et sidebars avant chaque test pour éviter les interférences
        unregister_widget(YoutubeWidget::class);
        unregister_sidebar('homepage');
    }

    public function testCustomWidgetIsRegistered()
    {
        register_custom_widget();

        // Vérifier que le widget YoutubeWidget a bien été enregistré
        global $wp_widget_factory;
        $this->assertArrayHasKey(YoutubeWidget::class, $wp_widget_factory->widgets, 'Le widget YoutubeWidget devrait être enregistré.');
    }

    public function testSidebarIsRegistered()
    {
        register_custom_widget();

        // Vérifier que la sidebar 'homepage' a bien été enregistrée
        global $wp_registered_sidebars;
        $this->assertArrayHasKey('homepage', $wp_registered_sidebars, 'La sidebar "homepage" devrait être enregistrée.');

        // Vérifier les configurations de la sidebar 'homepage'
        $sidebar = $wp_registered_sidebars['homepage'];
        $this->assertEquals('Sidebar Accueil', $sidebar['name'], 'Le nom de la sidebar "homepage" devrait être "Sidebar Accueil".');
        $this->assertEquals('<div class="p-4 %2$s" id="%1$s">', $sidebar['before_widget'], 'Le paramètre "before_widget" de la sidebar "homepage" devrait être "<div class="p-4 %2$s" id="%1$s">".');
        $this->assertEquals('</div>', $sidebar['after_widget'], 'Le paramètre "after_widget" de la sidebar "homepage" devrait être "</div>".');
        $this->assertEquals('<h4 class="font-italic">', $sidebar['before_title'], 'Le paramètre "before_title" de la sidebar "homepage" devrait être "<h4 class="font-italic">".');
        $this->assertEquals('</h4>', $sidebar['after_title'], 'Le paramètre "after_title" de la sidebar "homepage" devrait être "</h4>".');
    }
}