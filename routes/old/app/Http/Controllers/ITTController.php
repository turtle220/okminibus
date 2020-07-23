<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ITTController extends Controller
{
	
	public $Statuses = [
			"P"=>"Pendiente",
			"E"=>"Enviado",
	]; 

	public $Types = [
			"A"=>"Llegada",
			"D"=>"Salida",
	]; 
	
   	public function index()
    {
        return view('home');
    }
    
	public function all($order=1, $filter="0", $search="")
	{
		$BookingTickets = [ "BTicketId",
					"BTicketId",
					"BTicketId",
					"BTicketId",
					"BTicketId"
		];
		
		$order = intval($order,10);
		
		
		if($filter=="0")
		{
			if($search=="")
				$BookingTickets = \App\Models\BookingTicket::orderBy($BookingTickets[$order], 'desc')->paginate(20);
			else
				$BookingTickets = \App\Models\BookingTicket::where('BTicketId', $search)->orWhere('BTicketRef', 'like', '%' . $search. '%')->orWhere('ClientId', 'like', '%' . $search . '%')->orderBy($BookingTickets[$order], 'desc')->paginate(20);
		}
		else 
		{
			if($search=="")
				$BookingTickets = \App\Models\BookingTicket::where('StatusId', $filter)->orderBy($BookingTickets[$order], 'desc')->paginate(20);
			else
				$BookingTickets = \App\Models\BookingTicket::where('StatusId', $filter)->where(function($q) use($search) {
         						 $q->Where('BTicketRef', 'like', '%' . $search. '%')->orWhere('ClientId', 'like', '%' . $search . '%');
      				})->orderBy($BookingTickets[$order], 'desc')->paginate(20);
		}
		 
		$BookingTickets2 = [];
		for($x=0;($x < count($BookingTickets));$x++)
		{
			$BookingTickets2[$x] = $BookingTickets[$x]->toArray();
			$BookingTickets2[$x]["StatusId"] = $this->Statuses[$BookingTickets2[$x]["StatusId"]];
		}		
		$Estados["0"] = "Todos los estados";
		foreach ($this->Statuses as $key => $value)
			$Estados[$key] = $value;
		return view('BookingTickets/all', [
				'BookingTickets'	=> $BookingTickets,
				'BookingTickets2'	=> $BookingTickets2,
				"Estados" 	=> $Estados,
				"StatusId" 	=> $filter,
				"search" 	=> $search,
				"order" 	=> $order		
		]);	
	}
	 
		
	public function show()
	{ 
		if(($_GET["BTicketId"]== "")
			||(!$BookingTicket = \App\Models\BookingTicket::where('BTicketId', $_GET["BTicketId"])->first()))
		{
			$BookingTicket 						=  (object) [];
			$BookingTicket->BTicketId 			= uniqid();
			$BookingTicket->BTicketRef 			= "";
			$BookingTicket->Name 				= "";
			$BookingTicket->Hotel 				= "";
			$BookingTicket->StatusId 			= "P";
		}
		$BookingTicket->Status = $this->Statuses[$BookingTicket->StatusId];
		$BookingTicket->Type = $this->Types[$BookingTicket->TypeId];
		
		return view('BookingTickets/show', [
				"BookingTicket" => $BookingTicket,
				"Statuses"=>$this->Statuses,
		]);		
	}
		
	public function edit()
	{
		if(($_GET["BTicketId"]== "")
			||(!$BookingTicket = \App\Models\BookingTicket::where('BTicketId', $_GET["BTicketId"])->first()))
		{
			$Ticket = \App\Models\BookingTicket::whereRaw('id = (select max(`id`) from booking_tickets)')->first();
			if($Ticket)
				$BTicketRef = $Ticket->id+1;
			else
				$BTicketRef = 1;
			$BookingTicket 						=  (object) [];
			$BookingTicket->BTicketId 			= uniqid();
			$BookingTicket->BTicketRef 			= $BTicketRef+1;
			$BookingTicket->Name 				= "";
			$BookingTicket->Hotel 				= "";
			$BookingTicket->Phone 				= "+49";
			for($x=0;$x < 11;$x++)
				$BookingTicket->Phone 			.= random_int (0,9);
			
            $BookingTicket->BTDate 				= date("d/m/Y", strtotime("now"));
			$BookingTicket->BTTime 				= date("H:i", strtotime("now + 1 hour"));
			$BookingTicket->Departure 			= "";
			$BookingTicket->DFlightNo 			= "";
			$BookingTicket->Arrival 			= "";
			$BookingTicket->AFlightNo 			= "";
			$BookingTicket->Passport 			= "";
			$BookingTicket->PAX 				= 0;
			$BookingTicket->Price 				= 0;
			$BookingTicket->StatusId 			= "P";
			$BookingTicket->TypeId				= "A";
		}
						
		return view('BookingTickets/edit', [
				"BookingTicket" => $BookingTicket,
				"Statuses"=>$this->Statuses,
				"Types"=>$this->Types,				
		]);		
	}
		
	public function save(Request $request)
	{
		$Error = false;

		if($BookingTicket = \App\Models\BookingTicket::where('BTicketId', $_GET["BTicketId"])->first())
		{
			$BookingTicket->BTicketRef 			= str_replace(' ', '', strtoupper($_POST["BTicketRef"]));
			$BookingTicket->Name 				= urldecode($_POST["Name"]);
			$BookingTicket->Hotel 				= urldecode($_POST["Hotel"]);			
			$BookingTicket->Phone 				= $_POST["Phone"];
            $BookingTicket->BTDate 				= $_POST["BTDate"];
			$BookingTicket->BTTime 				= $_POST["BTTime"];
			$BookingTicket->TypeId				= $_POST["TypeId"];
//			$BookingTicket->Departure 			= $_POST["Departure"];
			$BookingTicket->DFlightNo 			= $_POST["DFlightNo"];
/*			$BookingTicket->Arrival 			= $_POST["Arrival"];
			$BookingTicket->AFlightNo 			= $_POST["AFlightNo"];*/
			$BookingTicket->PAX 				= intval($_POST["PAX"],10);
			$BookingTicket->Price 				= floatval($_POST["Price"]);
			$BookingTicket->StatusId 			= $_POST["StatusId"];
			$BookingTicket->Passport 			= $_POST["Passport"];
			$BookingTicket->save();
		}
		else
		{
			$BookingTicket = \App\Models\BookingTicket::create([
				'BTicketId' 				=> $_GET["BTicketId"],
        		'BTicketRef' 				=> str_replace(' ', '', strtoupper($_POST["BTicketRef"])),
        		'Name' 						=> urldecode($_POST["Name"]),
        		'Hotel' 					=> urldecode($_POST["Hotel"]),					
				'Phone' 					=> $_POST["Phone"],
            	'BTDate' 					=> $_POST["BTDate"],
				'BTTime' 					=> $_POST["BTTime"],
				'TypeId'					=> $_POST["TypeId"],
//				'Departure' 				=> $_POST["Departure"],
				'DFlightNo' 				=> $_POST["DFlightNo"],
/*				'Arrival' 					=> $_POST["Arrival"],
				'AFlightNo' 				=> $_POST["AFlightNo"],*/
				'PAX' 						=> intval($_POST["PAX"],10),
				'Price' 					=> floatval($_POST["Price"]),
				'StatusId' 					=> $_POST["StatusId"],
				'Passport' 					=> $_POST["Passport"],
			]);
		}
		
		if(!$Error)
		{
			$BookingTicket = \App\Models\BookingTicket::where('BTicketId', $_GET["BTicketId"])->first();
			$BookingTicket->Status = $this->Statuses[$BookingTicket->StatusId];
			$BookingTicket->Type = $this->Types[$BookingTicket->TypeId];
			$Out["ItsOk"] = "Y";
	    	$Out["Html"] = view('BookingTickets/show', [
					"BookingTicket" => $BookingTicket,
					"Statuses"		=>$this->Statuses,
	    	])->render();
		}
		else 
		{
			$Out["ItsOk"] = "N";
	    	$Out["Html"] = "Error";
		}
    	return $Out;
	}
    
	
	public function PdfTicket($BTicketId)
	{
		$out = false;
		if($BookingTicket = \App\Models\BookingTicket::where('BTicketId', $BTicketId)->first())
		{
			$pdf = \PDF::loadView('pdf.'.env('TICKET_TEMPLATE', 'itt'), [
						"BookingTicket" => $BookingTicket,
			]);
			$out = $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream();
		}

		\Mail::to(env('MAIL_TO_ADDRESS', 'eperez@openfenix.com'))
 	    	->send((new \App\Mail\Plantilla([]))
    					->attachData($pdf->output(), 'booking.pdf')
    					->subject('Nuevo ticket'));

		
		return $out;
	}
	
        
}
