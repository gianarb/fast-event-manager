# FastEventManager
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gianarb/fast-event-manager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gianarb/fast-event-manager/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/gianarb/fast-event-manager/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gianarb/fast-event-manager/?branch=master)
[![Build Status](https://travis-ci.org/gianarb/fast-event-manager.svg)](https://travis-ci.org/gianarb/fast-event-manager)

PHP event manager based on regex. Trigger events and attach listeners, core feature
easy to understand and to extend.

## Install

```bash
$ composer install gianarb/fast-event-manager
```

## Usage

## Getting Started
This is the basic usage
```php
<?php
use FastEventManager\EventManager;

$eventManager = new EventManager();

$eventManager->attach("post-save", function ($assertArg) {
    // DO STUFF
});

$assert = false;
$eventManager->trigger("/post-save/", $assert);
```

## Priority
FastEventManager support priority listeners
```php
$eventManager = new EventManager();

$eventManager->attach("post-save", function ($assertArg) {
    echo "Hi";
}, 100);

$eventManager->attach("post-save", function ($assertArg) {
    echo " dev!";
}, 10);

$eventManager->trigger("/post-save/");

// output "Hi dev!"
```

## Regex
FastEventManager resolve regex, you can trigger more events.
```php
$eventManager = new EventManager();

$eventManager->attach("post-save", function ($assertArg) {
    echo "Hi";
});

$eventManager->attach("pload", function ($assertArg) {
    echo " none!";
});

$eventManager->attach("post-load", function ($assertArg) {
    echo " dev!";
});

$eventManager->trigger("/post-(save|load)/i", $assert);

// output "Hi dev!"
```
