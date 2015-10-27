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

```php
<?php
use FastEventManager\EventManager;

$eventManager = new EventManager();
$assert = false;
$eventManager->attach("post-save", function ($assert) {
    $this->assertSame("override", $assert);
});

$eventManager->trigger("/post-save/", ["override"]);
```
