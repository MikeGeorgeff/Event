<?php

namespace Georgeff\Event;

interface GeneratorInterface
{
    /**
     * Add an event to the events queue
     *
     * @param string|object $event
     * @return void
     */
    public function raise($event);

    /**
     * Release all pending events
     *
     * @return array
     */
    public function release();
}