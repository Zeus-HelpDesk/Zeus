<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash')->index();
            $table->text('description');
            $table->integer('district_id')->unsigned()->index();
            $table->integer('building_id')->unsigned()->index();
            $table->string('room');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->integer('priority_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('status_id')->unsigned()->index();
            $table->timestampTz('completed_at')->nullable();
            $table->timestampsTz();

            // When a district, building or user is deleted we delete the tickets belonging to that entity
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
