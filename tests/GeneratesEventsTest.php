<?php

namespace Georgeff\Event\Test;

use Georgeff\Event\GeneratesEvents;

class GeneratesEventsTest extends TestCase
{
    use GeneratesEvents;

    public function testRaiseAndRelease()
    {
        $this->raise('event_one');
        $this->raise('event_two');

        $this->assertEquals(['event_one', 'event_two'], $this->release());
        $this->assertEmpty($this->release());
    }
}