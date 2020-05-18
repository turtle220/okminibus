<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTicket extends Model
{
   protected $table = 'booking_tickets';

    protected $fillable = [
            'BTicketId',
            'BTicketRef',
            'Hotel',
            'Name',
            'Phone',
            'BTDate',
			'BTTime',
    		'Passport',
			'Departure',
			'DFlightNo',
			'Arrival',
			'AFlightNo',
    		'PAX',
			'Price', 
			'MetaData',
            'StatusId',    		
            'TypeId',    		
    ];
}
