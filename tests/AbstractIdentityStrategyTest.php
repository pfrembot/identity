<?php
/**
 * File AbstractIdentityStrategyTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity\Tests;

use Pfrembot\Identity\AbstractIdentityStrategy;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit_Framework_TestCase;

/**
 * Class AbstractIdentityStrategyTest
 *
 * @package Pfrembot\Identity\Tests
 */
class AbstractIdentityStrategyTest extends PHPUnit_Framework_TestCase
{
    public function testInvoke()
    {
        /** @var AbstractIdentityStrategy|MockObject $strategy */
        $strategy = $this->getMockForAbstractClass(AbstractIdentityStrategy::class);

        $strategy->expects($this->once())->method('next')->willReturn('123');

        $this->assertEquals('123', $strategy());
    }

    public function testToString()
    {
        /** @var AbstractIdentityStrategy|MockObject $strategy */
        $strategy = $this->getMockForAbstractClass(AbstractIdentityStrategy::class);

        $results = ['123', '456'];
        $strategy->expects($this->exactly(2))->method('next')->willReturnCallback(function() use (&$results) {
            return array_shift($results);
        });

        $this->assertEquals('123', (string) $strategy);

        $strategy();

        $this->assertEquals('456', (string) $strategy);
    }

    public function testCurrent()
    {
        /** @var AbstractIdentityStrategy|MockObject $strategy */
        $strategy = $this->getMockForAbstractClass(AbstractIdentityStrategy::class);

        $results = ['123', '456'];
        $strategy->expects($this->exactly(2))->method('next')->willReturnCallback(function() use (&$results) {
            return array_shift($results);
        });

        $this->assertEquals('123', $strategy->current());

        $strategy();

        $this->assertEquals('456', $strategy->current());
    }
}
