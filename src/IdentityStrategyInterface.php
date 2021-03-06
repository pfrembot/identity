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
     * @return mixed
     */
    public function next();

    /**
     * Return the current ID
     *
     * @return mixed
     */
    public function current();

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
