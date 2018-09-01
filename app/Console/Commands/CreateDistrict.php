<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateDistrict extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zeus:create:district';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create district';

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
        //
    }
}
