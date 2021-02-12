#EventSubscriber

ZF2 Module. One place for manage application events.

##Installation

Add to your `composer.json`:
```
"petap/event-subscriber": "^0.1.*"
```

And to your `config/application.config.php`:
```
'modules' => [
    // ...
    'Petap\EventSubscriber',
    // ...
],
```

##Problem

As usual your event handlers everywhere, and you (or team member) don't know what will be executed
when you see this code `$this->getEventManager()->trigger($event);`. You spend many time with
`Crtl+F` in whole project.

##Solution

It just recommendation (or team rule) - describe all your handlers in one place in your
`module.config.php`:

```
    'events' => [
        'Laminas\Mvc\Application' => [
            'render' => [
                SomeListenerOne::class,
            ],
        ],
        'Users\User\Infrastructure\Repository' => [
            'create' => [
                SomeListenerTwo::class,
                SomeListenerThree::class,
            ],
        ],
        'Users\User\Infrastructure\Repository' => [
            'status:change' => [
                CreateTimelineEntryListener::class,
                UserNotifyListener::class,
                ExpireUserTokensListener::class,
                AdminLogListener::class,
            ],
        ],
        
        // ...
        'EventIdentifier' => [
            'EventName' => [
                'Callback1', // can be invokable class
                'Callback2',
                // ...
                'CallbackN',
            ],
        ],
    ],
```

`Petap\EventSubscriber` - read this config and attach every handler in described event.


##Dev

####Build
``
docker build --build-arg UID=$(id -u) --build-arg GID=$(id -g) -t event-subscriber:latest .
``
####Enter to container
``
docker run -ti -v $(pwd):/var/www/event-subscriber event-subscriber su --shell=/bin/bash www-data
``

####Run test

``
docker run -ti -v $(pwd):/var/www/event-subscriber event-subscriber su --shell=/bin/bash www-data -c "composer install --no-scripts --no-interaction --optimize-autoloader && ./vendor/bin/phpunit"
``