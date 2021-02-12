<?php

namespace Petap\EventSubscriberTest;

use Laminas\ServiceManager\ServiceLocatorInterface;
use Petap\EventSubscriber\Subscriber;
use Petap\EventSubscriber\SubscriberFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class PhpArrayFactoryTest extends TestCase
{
    use ProphecyTrait;

    private $serviceLocator;

    public function setUp() : void
    {
        $this->serviceLocator = $this->prophesize(ServiceLocatorInterface::class);
    }

    public function testAuthenticate()
    {
        $factory = new SubscriberFactory();

        $adapter = $factory($this->serviceLocator->reveal(), '');

        $this->assertTrue($adapter instanceof Subscriber);
    }
}
