<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTickets extends Migration
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
            $table->string('BTDate',10)->default('');
			$table->string('BTTime',5)->default('');
			$table->string('Passport')->default('');
			$table->string('Departure')->default('');
			$table->string('DFlightNo')->default('');
			$table->string('Arrival')->default('');
			$table->string('AFlightNo')->default('');
			$table->integer('PAX')->default(0);
			$table->decimal('Price', 8, 2)->default(0);
			$table->string('MetaData',4045)->default('');
            $table->string('StatusId',1)->default('P');
            $table->string('TypeId',1)->default('A');
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
        //Schema::dropIfExists('booking_tickets');
    }
}
