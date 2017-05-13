<?php

namespace Georgeff\Event;

trait GeneratesEvents
{
    /**
     * Array of queued events
     *
     * @var array
     */
    protected $eventsQueue = [];

    /**
     * {@inheritdoc}
     */
    public function raise($event)
    {
        $this->eventsQueue[] = $event;
    }

    /**
     * {@inheritdoc}
     */
    public function release()
    {
        $events = $this->eventsQueue;

        $this->eventsQueue = [];

        return $events;
    }
}