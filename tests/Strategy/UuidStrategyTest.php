<?php
/**
 * File UuidStrategyTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity\Tests;

use Pfrembot\Identity\Strategy\UuidStrategy;
use PHPUnit_Framework_TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidStrategyTest
 * \
 * @package Pfrembot\Identity\Tests
 */
class UuidStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider uuidVersionDataProvider
     * @param null|string $version
     */
    public function testConstruct($version)
    {
        $strategy = new UuidStrategy($version);

        $this->assertAttributeEquals($version, 'version', $strategy);
    }

    /**
     * @dataProvider uuidVersionDataProvider
     * @param null|string $version
     */
    public function testNext($version)
    {
        $strategy = new UuidStrategy($version);

        $this->assertTrue(Uuid::isValid($strategy->next()));
    }

    /**
     * @return array
     */
    public function uuidVersionDataProvider()
    {
        return [
            'default' => [null],
            UuidStrategy::VERSION_1 => [UuidStrategy::VERSION_1],
            UuidStrategy::VERSION_3 => [UuidStrategy::VERSION_3],
            UuidStrategy::VERSION_4 => [UuidStrategy::VERSION_4],
            UuidStrategy::VERSION_5 => [UuidStrategy::VERSION_5],
        ];
    }
}
