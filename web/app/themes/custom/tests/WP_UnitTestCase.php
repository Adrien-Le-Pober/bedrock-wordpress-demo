<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Brain\Monkey;

class WP_UnitTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp(); // Assurez-vous que cela est correct
    }

    protected function tearDown(): void
    {
        Monkey\tearDown(); // Assurez-vous que cela est correct
        parent::tearDown();
    }
}