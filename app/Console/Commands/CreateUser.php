<?php

namespace App\Console\Commands;

use App\Building;
use App\District;
use App\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zeus:create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a user Entry';

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
        // Ask all the questions needed
        $user['invite_code'] = $this->ask('What is the users invite code?');
        $user['name'] = $this->ask('What is the users name?');
        $user['email'] = $this->ask('What is the users email?');
        $user['password'] = $this->secret('What is the users password?');
        $user['room'] = $this->ask('What is the users room?');
        if ($this->confirm('Is the user staff?')) {
            $user['staff'] = true;
        } else {
            $user['staff'] = false;
        }

        $validate = \Validator::make($user, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'room' => 'required|string',
        ]);

        if ($validate->fails()) {
            $this->error($validate->messages());
        }

        $user = (object)$user;
        // Confirm the data
        $this->info('This is the date you entered:');
        $this->info("Invite Code: $user->invite_code");
        $this->info("Name: $user->name");
        $this->info("Email: $user->email");
        $this->info("Password: Hidden for Security");
        $this->info("Room: $user->room");
        if ($this->confirm('Does this data look correct?')) {
            $split = explode('-', $user->invite_code);
            $district = District::whereCode($split[0])->firstOrFail(['id', 'name']);
            $building = Building::whereDistrictId($district->id)->whereCode($split[1])->firstOrFail(['id', 'name']);

            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => \Hash::make($user->password),
                'district_id' => $district->id,
                'building_id' => $building->id,
                'room' => $user->room,
                'staff' => $user->staff
            ]);
            $this->info('Success! This is the user info:');
            $this->info("Name: $user->name");
            $this->info("Email: $user->email");
            $this->info("Password: Hidden for security");
            $this->info("Room: $user->room");
            $this->info("Staff Member: $user->staff");
            $this->info("District: $district->name");
            $this->info("Building: $building->name");
        } else {
            $this->error('You said the data was incorrect, ending command');
        }
    }
}
