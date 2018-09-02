<?php

namespace App\Console\Commands;

use App\Ticket;
use Illuminate\Console\Command;
use niiknow\Bayes;

class Train extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zeus:train';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Train the system for auto categorization and priorities';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tickets = Ticket::all(['description', 'priority_id', 'category_id']); // Get all the tickets for training
        $priority_classifier = new Bayes();
        $category_classifier = new Bayes();
        // Teach priorities
        foreach ($tickets as $ticket) {
            $priority_classifier->learn($ticket->description, $ticket->priority_id);
        }
        \Storage::put('/training/priorities.json', $priority_classifier->toJson());
        // Teach categories
        foreach ($tickets as $ticket) {
            $category_classifier->learn($ticket->description, $ticket->category_id);
        }
        \Storage::put('/training/categories.json', $category_classifier->toJson());

        $this->info('Trained successfully!');
    }
}
