# FastEventManager
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
