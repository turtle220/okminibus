<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_tickets', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('BTicketId')->default('');
            $table->string('BTicketRef')->default('');
            $table->string('Hotel')->default('');
            $table->string('Name')->default('');
            $table->string('Phone')->default('');
            $table->string('BTDate')->default('');
            $table->string('BTTime')->default('');
            $table->string('Passport')->default('');
            $table->string('Departure')->default('');
            $table->string('DFlightNo')->default('');
            $table->string('Arrival')->default('');
            $table->string('AFlightNo')->default('');
            $table->integer('PAX')->default(0);
            $table->decimal('Price', 8, 2)->default(0);
            $table->string('MetaData',4045)->default('');
            $table->string('Status')->default('P');//1: pending 2: sent
            $table->string('TypeId',1)->default('A');
            $table->integer('user_id');
            $table->string('areaname')->nullable();
            $table->string('destination')->nullable();
            $table->string('observation')->nullable();
            $table->string('provision')->nullable();
            $table->string('transfer')->nullable();
            $table->string('origin')->nullable();
            $table->string('paradas')->nullable();
            $table->string('destination')->nullable();
            $table->string('sd')->nullable();
            $table->string('dr')->nullable();
            $table->string('dc')->nullable();
            $table->string('tu')->nullable();
            $table->string('cif')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookingtickets');
    }
}
