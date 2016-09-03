<?php
/**
 * File AbstractIdentityStrategy.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity;

/**
 * Class AbstractIdentityStrategy
 *
 * @package Pfrembot\Identity
 */
abstract class AbstractIdentityStrategy implements IdentityStrategyInterface
{
    /**
     * @var string|int
     */
    protected $currentId;

    /**
     * {@inheritdoc}
     */
    public function __invoke()
    {
        $this->currentId = $this->next();

        return $this->currentId;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->currentId;
    }
}