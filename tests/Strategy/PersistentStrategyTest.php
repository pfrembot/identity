<?php
/**
 * File PersistentStrategyTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity\Tests;

use Pfrembot\Identity\Strategy\IncrementalStrategy;
use Pfrembot\Identity\Strategy\PersistentStrategy;
use PHPUnit_Framework_TestCase;

/**
 * Class PersistentStrategyTest
 *
 * @package Pfrembot\Identity\Tests
 */
class PersistentStrategyTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        parent::tearDown();

        $reflection = new \ReflectionProperty(PersistentStrategy::class, 'strategy');
        $reflection->setAccessible(true);
        $reflection->setValue(null, null);

        $reflection = new \ReflectionProperty(PersistentStrategy::class, 'original');
        $reflection->setAccessible(true);
        $reflection->setValue(null, null);
    }

    public function testConstruct()
    {
        $internal = new IncrementalStrategy();
        $strategy = new PersistentStrategy($internal);

        $this->assertAttributeSame($internal, 'strategy', $strategy);
    }

    public function testNext()
    {
        $internal = new IncrementalStrategy();
        $strategy = new PersistentStrategy($internal);

        $this->assertEquals(1, $strategy->next());
        $this->assertEquals(2, $strategy->next());
        $this->assertEquals(3, $strategy->next());
    }

    public function testCurrent()
    {
        $internal = new IncrementalStrategy();
        $strategy = new PersistentStrategy($internal);

        $this->assertEquals(0, $strategy->current());

        $strategy->next();
        $this->assertEquals(1, $strategy->current());
        $this->assertEquals(2, $strategy->next());
        $this->assertEquals(3, $strategy->next());
    }

    public function testPersistence()
    {
        $internal = new IncrementalStrategy();
        $strategy = new PersistentStrategy($internal);

        $this->assertEquals(1, $strategy->next());
        $this->assertEquals(2, $strategy->next());
        $this->assertEquals(3, $strategy->next());

        $internal = new IncrementalStrategy(5);
        $strategy = new PersistentStrategy($internal);

        $this->assertEquals(4, $strategy->next());
        $this->assertEquals(5, $strategy->next());
        $this->assertEquals(6, $strategy->next());
    }

    public function testReset()
    {
        $internal = new IncrementalStrategy();
        $strategy = new PersistentStrategy($internal);

        $this->assertEquals(1, $strategy->next());
        $this->assertEquals(2, $strategy->next());
        $this->assertEquals(3, $strategy->next());

        $strategy->reset();

        $this->assertEquals(1, $strategy->next());
        $this->assertEquals(2, $strategy->next());
        $this->assertEquals(3, $strategy->next());
    }

    public function testResetWithNewStrategy()
    {
        $internal = new IncrementalStrategy();
        $strategy = new PersistentStrategy($internal);

        $this->assertEquals(1, $strategy->next());
        $this->assertEquals(2, $strategy->next());
        $this->assertEquals(3, $strategy->next());

        $strategy->reset(new IncrementalStrategy(5));

        $this->assertEquals(6, $strategy->next());
        $this->assertEquals(7, $strategy->next());
        $this->assertEquals(8, $strategy->next());
    }
}
