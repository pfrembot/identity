<?php
/**
 * File IdentityStrategyInterface.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity;

/**
 * Interface IdentityStrategyInterface
 *
 * @package Pfrembot\Identity
 */
interface IdentityStrategyInterface
{
    /**
     * Return the next ID
     *
     * @return int|string
     */
    public function next();

    /**
     * Increment Identity
     *
     * @return int|string
     */
    public function __invoke();

    /**
     * Return the current Identity
     *
     * @return string
     */
    public function __toString();
}
