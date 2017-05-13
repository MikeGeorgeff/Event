<?php

namespace Georgeff\Event;

use Illuminate\Contracts\Events\Dispatcher;

class Event
{
    /**
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $dispatcher;

    /**
     * @param \Illuminate\Contracts\Events\Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Dispatch an event
     *
     * @param string|object $event
     * @param mixed         $payload
     * @param bool          $halt
     * @return array|null
     */
    public function dispatch($event, $payload = [], $halt = false)
    {
        return $this->dispatcher->dispatch($event, $payload, $halt);
    }

    /**
     * Dispatch all raised events for a given entity
     *
     * @param \Georgeff\Event\GeneratorInterface $entity
     * @return void
     */
    public function dispatchFor(GeneratorInterface $entity)
    {
        foreach ($entity->release() as $event) {
            $this->dispatch($event);
        }
    }

    /**
     * Register an event listener
     *
     * @param string|array $events
     * @param mixed        $listener
     * @return void
     */
    public function listen($events, $listener)
    {
        $this->dispatcher->listen($events, $listener);
    }

    /**
     * Get the underlying dispatcher instance
     *
     * @return \Illuminate\Contracts\Events\Dispatcher
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }
}