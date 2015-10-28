<?php
namespace FastEventManagerTest;

use PHPUnit_Framework_TestCase;
use FastEventManager\EventManager;
use PHPUnit_Framework_Assert;

class EventManagerTest extends PHPUnit_Framework_TestCase
{
    public function testEventManagerHasZeroListeners()
    {
        $eventManager = new EventManager();
        $listeners = PHPUnit_Framework_Assert::readAttribute($eventManager, 'listeners');
        $this->assertCount(0, $listeners);
    }

    public function testAttachFirstListener()
    {
        $eventManager = new EventManager();
        $eventManager->attach("post-save", function () {
        });
        $listeners = PHPUnit_Framework_Assert::readAttribute($eventManager, 'listeners');
        $this->assertCount(1, $listeners);
    }

    public function testCallEvent()
    {
        $eventManager = new EventManager();
        $eventManager->attach("post-save", function ($assert) {
            $this->assertSame("override", $assert);
        });

        $eventManager->trigger("/post-save/", ["override"]);
    }

    public function testAttachEventCheckName()
    {
        $eventManager = new EventManager();
        $eventManager->attach("post-save", function () {
        });
        $listeners = PHPUnit_Framework_Assert::readAttribute($eventManager, 'listeners');
        $this->assertTrue(array_key_exists("post-save", $listeners));
    }

    public function testAttachTwoListenersSameEventAndCheckEventNameIntoTheListeners()
    {
        $eventManager = new EventManager();
        $eventManager->attach("post-save", function () {
        });
        $eventManager->attach("post-save", function () {
        });
        $listeners = PHPUnit_Framework_Assert::readAttribute($eventManager, 'listeners');
        $this->assertCount(1, $listeners);
    }

    public function testAttachTwoListenersSameEvent()
    {
        $eventManager = new EventManager();

        $eventManager->attach("post-save", function () {
        });
        $eventManager->attach("post-save", function () {
        });

        $listeners = PHPUnit_Framework_Assert::readAttribute($eventManager, 'listeners');
        $this->assertCount(2, $listeners['post-save']);
    }

    public function benchmarkTriggerAValidCallback($b)
    {
        $eventManager = new EventManager();
        $eventManager->attach("post-save", function ($assert) {});

        for ($i=0; $i<$b->times(); $i++) {
            $eventManager->trigger("/post-save/", ["override"]);
        }
    }

    public function benchmarkZendFrameworkEventManager($b)
    {
        $eventManager = new \Zend\EventManager\EventManager();
        $eventManager->attach("post-save", function ($assert) {});

        for ($i=0; $i<$b->times(); $i++) {
            $eventManager->trigger("post-save", $this, ["override"]);
        }
    }
}
