<?php

namespace Petap\EventSubscriber;

return [
    'service_manager' => [
        'factories' => [
            Subscriber::class => SubscriberFactory::class
        ],
    ],
];
