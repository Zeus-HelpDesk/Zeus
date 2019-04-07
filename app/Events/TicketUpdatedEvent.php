<?php

namespace App\Events;

use App\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketUpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $ticket;

    /**
     * Create a new event instance.
     *
     * @param $ticket Ticket
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('ticket:' . $this->ticket->id);
    }
}
