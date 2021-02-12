<?php

namespace Petap\EventSubscriber;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Class SubscriberFactory
 * @package Petap\EventSubscriber
 */
class SubscriberFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Subscriber($container);
    }
}
