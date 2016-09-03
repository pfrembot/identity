<?php
/**
 * File IncrementalStrategy.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace Pfrembot\Identity\Strategy;

use Pfrembot\Identity\AbstractIdentityStrategy;

/**
 * Class IncrementalStrategy
 *
 * @package Pfrembot\Identity\Strategy
 */
class IncrementalStrategy extends AbstractIdentityStrategy
{
    /**
     * IncrementalStrategy constructor
     *
     * @param int $start
     */
    public function __construct($start = 0)
    {
        $this->currentId = $start;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->currentId++;

        return $this->currentId;
    }
}
