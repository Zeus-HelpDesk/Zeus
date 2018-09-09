<?php

namespace App\Console\Commands;

use App\District;
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
    protected $description = 'Creates a district entry';

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
        $district['name'] = $this->ask('What is the districts name?');
        $district['address'] = $this->ask('What is the districts address?', 'Address');
        $district['phone_number'] = $this->ask('What is the districts phone number? (Optional)', null);
        $district['phone_extension'] = $this->ask('What is the districts phone extension? (Optional)', null);
        $district['code'] = $this->ask('District Code? (Optional)', null);
        $validate = \Validator::make($district, [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'nullable|string',
            'phone_extension' => 'nullable|string',
            'code' => 'nullable|string|min:4|max:4|unique:districts,code'
        ]);

        if ($validate->fails()) {
            $this->error($validate->messages());
        }

        $district = (object)$district;
        $this->info('This is the date you entered:');
        $this->info("Name: $district->name");
        $this->info("Address: $district->address");
        $this->info("Phone Number: $district->phone_number");
        $this->info("Phone Extension: $district->phone_extension");
        $this->info("Code: $district->code");
        if ($this->confirm('Is this data correct?')) {
            District::create((array)$district);
            $this->info('District Created!');
        } else {
            $this->error('You said the data was incorrect, ending command');
        }
    }
}
