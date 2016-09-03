<?php
/**
 * File IncrementalStrategyTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity\Tests;

use Pfrembot\Identity\Strategy\IncrementalStrategy;
use PHPUnit_Framework_TestCase;

/**
 * Class IncrementalStrategyTest
 *
 * @package Pfrembot\Identity\Tests
 */
class IncrementalStrategyTest extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $strategy = new IncrementalStrategy();

        $this->assertAttributeEquals(0, 'currentId', $strategy);
    }

    public function testConstructWithDefault()
    {
        $strategy = new IncrementalStrategy(5);

        $this->assertAttributeEquals(5, 'currentId', $strategy);
    }

    public function testNext()
    {
        $strategy = new IncrementalStrategy();

        $this->assertEquals(1, $strategy->next());
        $this->assertEquals(2, $strategy->next());
        $this->assertEquals(3, $strategy->next());
    }

    public function testNextWithDefault()
    {
        $strategy = new IncrementalStrategy(5);

        $this->assertEquals(6, $strategy->next());
        $this->assertEquals(7, $strategy->next());
        $this->assertEquals(8, $strategy->next());
    }
}
