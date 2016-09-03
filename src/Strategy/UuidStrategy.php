<?php
/**
 * File UuidStrategy.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity\Strategy;

use Pfrembot\Identity\AbstractIdentityStrategy;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidStrategy
 *
 * @package Pfrembot\Identity\Strategy
 */
class UuidStrategy extends AbstractIdentityStrategy
{
    const VERSION_1 = 'uuid1';
    const VERSION_3 = 'uuid3';
    const VERSION_4 = 'uuid4';
    const VERSION_5 = 'uuid5';

    /**
     * @var string
     */
    private $version;

    /**
     * UuidStrategy constructor
     * @param string $version
     */
    public function __construct($version = self::VERSION_1)
    {
        $this->version = $version;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->currentId = $this->getUuid();

        return $this->currentId;
    }

    /**
     * Generate and return a new UUID
     *
     * @return string
     */
    private function getUuid()
    {
        switch ($this->version) {
            case self::VERSION_1:
                return Uuid::uuid1()->toString();
            case self::VERSION_3:
                return Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net')->toString();
            case self::VERSION_4:
                return Uuid::uuid4()->toString();
            case self::VERSION_5:
                return Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net')->toString();
        }

        return Uuid::uuid1()->toString();
    }
}
