<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTicket extends Model
{
    //
	use softDeletes;

	protected $fillable = ['BTicketId',
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
				            'user_id',
				            'destination',
				            'origin',
				            'observation',
				            'provision',
				            'transfer',
				            'sd',
				            'dr',
				            'dc',
				            'tu',
				            'cif',
				            'paradas', 
				        	'invoicelanguage',
				        	'extra'];
}
