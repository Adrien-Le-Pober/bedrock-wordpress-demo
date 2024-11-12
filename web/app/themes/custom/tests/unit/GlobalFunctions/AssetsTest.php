<?php

namespace App\Tests\Unit;

use WP_UnitTestCase;

class AssetsTests extends WP_UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        register_assets();
    }

    public function testBootstrapStyleRegistered()
    {
        $this->assertTrue(wp_style_is('bootstrap', 'registered'), true);
    }

    public function testPopperScriptRegistered()
    {
        $this->assertTrue(wp_script_is('popper', 'registered'), true);
    }

    public function testBootstrapScriptRegistered()
    {
        $this->assertTrue(wp_script_is('bootstrap', 'registered'), true);
    }

    public function testBootstrapStyleEnqueued()
    {
        $this->assertTrue(wp_style_is('bootstrap', 'enqueued'), true);
    }

    public function testBootstrapScriptEnqueued()
    {
        $this->assertTrue(wp_script_is('bootstrap', 'enqueued'), true);
    }

    public function testBootstrapScriptDependencies()
    {
        global $wp_scripts;

        $bootstrap_script = $wp_scripts->registered['bootstrap'];
        $this->assertContains('popper', $bootstrap_script->deps, true);
    }
}
