<?php
/**
 * File PersistentStrategy.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity\Strategy;

use Pfrembot\Identity\AbstractIdentityStrategy;

/**
 * Class PersistentStrategy
 *
 * @package Pfrembot\Identity\Strategy
 */
class PersistentStrategy extends AbstractIdentityStrategy
{
    /**
     * @var AbstractIdentityStrategy
     */
    private static $strategy;

    /**
     * @var AbstractIdentityStrategy
     */
    private static $original;

    /**
     * PersistentStrategy constructor
     *
     * @param AbstractIdentityStrategy $strategy
     */
    public function __construct(AbstractIdentityStrategy $strategy)
    {
        self::$strategy = self::$strategy ?: $strategy;
        self::$original = self::$original ?: clone $strategy;
    }

    /**
     * Reset the internally persisted strategy and optionally
     * provide a new internal strategy to use
     *
     * @param AbstractIdentityStrategy|null $strategy
     * @return $this
     */
    public function reset(AbstractIdentityStrategy $strategy = null)
    {
        self::$strategy = $strategy ?: clone self::$original;
        self::$original = $strategy ?: self::$original;

        return $this;
    }

    /**
     * Return the next ID
     *
     * @return int|string
     */
    public function next()
    {
        return self::$strategy->next();
    }
}
