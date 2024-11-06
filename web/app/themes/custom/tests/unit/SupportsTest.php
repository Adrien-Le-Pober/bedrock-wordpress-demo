<?php

namespace App\Tests\Unit;

use WP_UnitTestCase;

require_once dirname(__DIR__, 2) . '/functions.php';

class SupportsTest extends WP_UnitTestCase
{
    public function testSupports()
    {
        $this->assertTrue(true, 'Les attentes de Brain Monkey n\'ont pas été remplies.');
    }
}
