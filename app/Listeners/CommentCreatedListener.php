<?php

namespace App\Listeners;

use App\Events\CommentCreatedEvent;

class CommentCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param CommentCreatedEvent $event
     * @return void
     */
    public function handle(CommentCreatedEvent $event)
    {
        //
    }
}
