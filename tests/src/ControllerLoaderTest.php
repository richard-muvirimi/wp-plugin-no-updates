<?php declare(strict_types=1);
/**
 * File for php unit testcases
 *
 * @author Richard Muvirimi <tygalive@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */

namespace Rich4rdMuvirimi\NoUpdates\Tests;

use Brain\Monkey;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Rich4rdMuvirimi\NoUpdates\NoUpdates;

/**
 * Test Cases class
 *
 * @author Richard Muvirimi <tygalive@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */
class ControllerLoaderTest extends TestCase
{

    // Adds Mockery expectations to the PHPUnit assertions count.
    use MockeryPHPUnitIntegration;

    /**
     * Test the loader class magic methods
     *
     * @return void
     * @version 1.0.0
     * @since 1.0.0
     */
    public function testHooks(): void
    {
        $loader = NoUpdates::instance();
        $loader->add_action('init', '__return_true', 25);
        $loader->add_filter('the_title', '__return_true', 25);

        // assert added.
        self::assertNotFalse(has_action('init', '__return_true'));
        self::assertNotFalse(has_filter('the_title', '__return_true'));

        // assert priority.
        self::assertSame(25, has_action('init', '__return_true'));
        self::assertSame(25, has_filter('the_title', '__return_true'));
    }

    /**
     * Tear Down
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }

    /**
     * SetUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

}
