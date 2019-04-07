<?php

namespace App\Listeners;

use App\Comment;
use App\Events\TicketUpdatedEvent;
use Mail;

class TicketUpdatedListener
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
     * @param TicketUpdatedEvent $event
     * @return void
     */
    public function handle(TicketUpdatedEvent $event)
    {
        $ticket = Comment::whereId($event->comment->id)->ticket;
        // Initialize the users array with the ticket creator already added
        $users = [$ticket->user];
        // Add anyone else whos commented to the list of users
        foreach ($ticket->comments as $comment) {
            $users[] = $comment->user;
        }
        foreach ($users as $user) {
            Mail::to($user)->queue();
        }
    }
}
