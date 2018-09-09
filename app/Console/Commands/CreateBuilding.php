<?php

namespace App\Console\Commands;

use App\Building;
use App\District;
use Illuminate\Console\Command;

class CreateBuilding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zeus:create:building';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a building entry';

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
        $building['name'] = $this->ask('What is the buildings name?');
        $building['address'] = $this->ask('What is the buildings address?', 'Address');
        $building['phone_number'] = $this->ask('What is the buildings phone number? (Optional)', null);
        $building['phone_extension'] = $this->ask('What is the buildings phone extension? (Optional)', null);
        $building['district'] = $this->choice('Which district is this building part of?', District::pluck('name')->toArray(), 0);

        $validate = \Validator::make($building, [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'nullable|string',
            'phone_extension' => 'nullable|string',
            'code' => 'nullable|string|min:4|max:4'
        ]);

        if ($validate->fails()) {
            $this->error($validate->messages());
        }

        $building = (object)$building;
        $this->info('This is the date you entered:');
        $this->info("Name: $building->name");
        $this->info("Address: $building->address");
        $this->info("Phone Number: $building->phone_number");
        $this->info("Phone Extension: $building->phone_extension");
        $this->info("District: $building->district");
        if ($this->confirm('Is this data correct?')) {
            $district = District::whereName($building->district)->first();
            $building->district_id = $district->id;
            $building = Building::create((array)$building);
            $this->info('Building Created!');
            $this->info("Users can now register using the invite code $district->code-$building->code");
        } else {
            $this->error('You said the data was incorrect, ending command');
        }
    }
}
