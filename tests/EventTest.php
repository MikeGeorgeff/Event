<?php

namespace Georgeff\Event\Test;

use Mockery as m;
use Georgeff\Event\Event;
use Georgeff\Event\GeneratorInterface;
use Illuminate\Contracts\Events\Dispatcher;

class EventTest extends TestCase
{
    public function testGetDispatcher()
    {
        $event = $this->getEvent();

        $this->assertInstanceOf(Dispatcher::class, $event->getDispatcher());
    }

    public function testDispatch()
    {
        $event = $this->getEvent();

        $event->getDispatcher()->shouldReceive('dispatch')->once()->andReturn('foo');

        $this->assertEquals('foo', $event->dispatch('TestEvent'));
    }

    public function testDispatchFor()
    {
        $event  = $this->getEvent();
        $entity = m::mock(GeneratorInterface::class);

        $entity->shouldReceive('release')->once()->andReturn(['event_one', 'event_two']);

        $event->getDispatcher()->shouldReceive('dispatch')->twice();

        $event->dispatchFor($entity);
    }

    public function testListen()
    {
        $event = $this->getEvent();

        $event->getDispatcher()->shouldReceive('listen')->once();

        $event->listen('event', 'listener');
    }

    /**
     * Get the event class
     *
     * @return Event
     */
    protected function getEvent()
    {
        return new Event(m::mock(Dispatcher::class));
    }

    protected function tearDown()
    {
        m::close();
    }
}