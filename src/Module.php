<?php

namespace Petap\EventSubscriber;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\EventManager\EventInterface;

/**
 * Class Module
 * @package Petap\EventSubscriber
 */
class Module implements ConfigProviderInterface, BootstrapListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $serviceManager  = $e->getApplication()->getServiceManager();
        $config = $serviceManager->get('Config');

        if (!isset($config['events']) || empty($config['events'])) {
            return;
        }

        /** @var Subscriber $subscriber */
        $subscriber = $serviceManager->get(Subscriber::class);
        $subscriber($config['events']);
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig($env = null)
    {
        return include dirname(__DIR__) . '/config/module.config.php';
    }
}
