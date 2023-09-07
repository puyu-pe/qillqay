<?php
 namespace PuyuPe\NexusPdf\Extension;

use Twig\RuntimeLoader\RuntimeLoaderInterface;

/**
 * Class RuntimeLoader.
 */
class RuntimeLoader implements RuntimeLoaderInterface
{
    public function load($class)
    {
        return new $class();
    }
}
