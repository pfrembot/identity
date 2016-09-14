<?php
/**
 * File PersistentStrategy.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity\Strategy;

use Pfrembot\Identity\AbstractIdentityStrategy;
use Pfrembot\Identity\IdentityStrategyInterface;

/**
 * Class PersistentStrategy
 *
 * @package Pfrembot\Identity\Strategy
 */
class PersistentStrategy extends AbstractIdentityStrategy
{
    /**
     * @var IdentityStrategyInterface
     */
    private static $strategy;

    /**
     * @var IdentityStrategyInterface
     */
    private static $original;

    /**
     * PersistentStrategy constructor
     *
     * @param IdentityStrategyInterface $strategy
     */
    public function __construct(IdentityStrategyInterface $strategy)
    {
        self::$strategy = self::$strategy ?: $strategy;
        self::$original = self::$original ?: clone $strategy;
    }

    /**
     * Reset the internally persisted strategy and optionally
     * provide a new internal strategy to use
     *
     * @param IdentityStrategyInterface|null $strategy
     * @return $this
     */
    public function reset(IdentityStrategyInterface $strategy = null)
    {
        self::$strategy = $strategy ?: clone self::$original;
        self::$original = $strategy ?: self::$original;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return self::$strategy->next();
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return self::$strategy->current();
    }
}
