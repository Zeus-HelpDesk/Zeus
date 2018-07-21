<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('room');
            $table->string('phone_number')->nullable();
            $table->integer('phone_extension')->nullable();
            $table->integer('district_id');
            $table->integer('building_id');
            $table->boolean('staff')->default(false);
            $table->rememberToken();
            $table->timestampsTz();

            // When a district is deleted so are all the users that are part of that district, same goes for buildings
            //$table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            //$table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
