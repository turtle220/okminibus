<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\BookingTicket;
use App\User;
use App\Area;   

class BookingController extends Controller
{
    //

    public $Statuses = [
            "P"=>"Pendiente",
            "p" => "Pendiente",
            "E"=>"Enviad",
            "e" => "Enviad"
    ]; 

    public $Types = [
            "A"=>"Llegada",
            "D"=>"Salida",
    ]; 



    public function __construct() {
    	$this->middleware('auth');
    }


    public function index($order=1, $filter="0", $search="")
    {
        $tickets = $this->getListTicket();

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
                $BookingTickets = BookingTicket::latest()->get();
            else
                $BookingTickets = BookingTicket::where('BTicketId', $search)->orWhere('BTicketRef', 'like', '%' . $search. '%')->orWhere('ClientId', 'like', '%' . $search . '%')->latest()->get();
        }
        else 
        {
            if($search=="")
                $BookingTickets = BookingTicket::where('StatusId', $filter)->latest()->get();
            else
                $BookingTickets = BookingTicket::where('StatusId', $filter)->where(function($q) use($search) {
                                 $q->Where('BTicketRef', 'like', '%' . $search. '%')->orWhere('ClientId', 'like', '%' . $search . '%');
                    })->latest()->get();
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

    	return view('BookingTickets.booking', [ 'values' => $tickets,
                                                'BookingTickets'   => $BookingTickets,
                                                'BookingTickets2'   => $BookingTickets2,
                                                "Estados"   => $Estados,
                                                "StatusId"  => $filter,
                                                "search"    => $search,
                                                "order"     => $order   ]);
    	//echo "you are logged in";
    }


    public function getListTicket()
    {
        $role = Auth::user()->role;
        $userid = Auth::user()->id;
        
        switch($role)
        {
            case 1:
                $results = BookingTicket::latest()
                                    ->orderby('name')
                                    ->get(); 
                break;
            case 2:
                $results = BookingTicket::where('user_id', $userid)
                                    ->latest()
                                    ->orderby('name')
                                    ->get();
                break;
            case 3:
                
                $results = BookingTicket::where('user_id', $userid)
                                    ->latest()
                                    ->orderby('name')
                                    ->get();
                break;
        }

        return $results;
    }

    // public function create(Request $request)
    // {
    //     $id = $request->id;

    //     $ticket = BookingTicket::find($id)->get();

    //     return response()->json(['ticket' => $ticket]);
    // }

    public function store(Request $request)
    {
            $BookingTicket = new BookingTicket;

            $BookingTicket->BTicketRef          = str_replace(' ', '', strtoupper($request->BTicketRef));
            $BookingTicket->Name                = urldecode($request->Name);
            $BookingTicket->Hotel               = urldecode($request->Hotel);           
            $BookingTicket->Phone               = $request->Phone;
            $BookingTicket->BTDate              = $request->BTDate;
            $BookingTicket->BTTime              = $request->BTTime;
            $BookingTicket->TypeId              = $request->TypeId;
            $BookingTicket->DFlightNo           = $request->DFlightNo;
            $BookingTicket->PAX                 = intval($request->PAX,10);
            $BookingTicket->Price               = floatval($request->Price);
            $BookingTicket->StatusId            = $request->StatusId;
            $BookingTicket->Passport            = $request->passport;
        
            $BookingTicket->save();
    }

    public function show()
    { 
        if(($_GET["BTicketId"]== "")
            ||(!$BookingTicket = BookingTicket::where('BTicketId', $_GET["BTicketId"])->first()))
        {
            $BookingTicket                      =  (object) [];
            $BookingTicket->BTicketId           = uniqid();
            $BookingTicket->BTicketRef          = "";
            $BookingTicket->Name                = "";
            $BookingTicket->Hotel               = "";
            $BookingTicket->StatusId            = "p";
        }

        $BookingTicket->Status = $this->Statuses[$BookingTicket->StatusId];
       // $BookingTicket->destination = $BookingTicket->destination;
        $BookingTicket->Type = $this->Types[$BookingTicket->TypeId];
        $areas = Area::get(); 
        
        return view('BookingTickets/show', [
                "BookingTicket" => $BookingTicket,
                "Statuses"=>$this->Statuses,
                'areas' => $areas   
        ]);     
    }
        
    
    // legacy code
    public function edit(Request $request)
    {
        if(($_GET["BTicketId"]== "")
            ||(!$BookingTicket = BookingTicket::where('BTicketId', $_GET["BTicketId"])->first()))
        {
            $Ticket = BookingTicket::whereRaw('id = (select max(`id`) from booking_tickets)')->first();
            if($Ticket)
                $BTicketRef = $Ticket->id+1;
            else
                $BTicketRef = 1;
            $BookingTicket                      =  (object) [];
            $BookingTicket->BTicketId           = uniqid();
            $BookingTicket->BTicketRef          = $BTicketRef+1;
            $BookingTicket->Name                = "";
            $BookingTicket->Hotel               = "";
            $BookingTicket->Phone               = "+49";
            for($x=0;$x < 11;$x++)
                $BookingTicket->Phone           .= random_int (0,9);
            
            $BookingTicket->BTDate              = date("d/m/Y", strtotime("now"));
            $BookingTicket->BTTime              = date("H:i", strtotime("now + 1 hour"));
            $BookingTicket->Departure           = "";
            $BookingTicket->DFlightNo           = "";
            $BookingTicket->Arrival             = "";
            $BookingTicket->AFlightNo           = "";
            $BookingTicket->Passport            = "";
            $BookingTicket->PAX                 = 0;
            $BookingTicket->Price               = 0;
            $BookingTicket->StatusId            = "P";
            $BookingTicket->TypeId              = "A";
            $BookingTicket->destination         = "";
            $BookingTicket->transfer            = "";
            $BookingTicket->origin              = "";
            $BookingTicket->observation         = "";
            $BookingTicket->provision           = "";
            $BookingTicket->destination        = "";
        }
        $users = User::where("role", 3)->get();
        $areas = Area::get();               
        return view('BookingTickets/edit', [
                "BookingTicket" => $BookingTicket,
                "Statuses"=>$this->Statuses,
                "Types"=>$this->Types,
                "users" => $users,
                "areas" => $areas              
        ]);     
    }
        

    public function save(Request $request)
    {
        $Error = false;

        if($BookingTicket = BookingTicket::where('BTicketId', $_GET["BTicketId"])->first())
        {
            $BookingTicket->BTicketRef          = str_replace(' ', '', strtoupper($_POST["BTicketRef"]));
            $BookingTicket->Name                = urldecode($_POST["Name"]);
            $BookingTicket->Hotel               = urldecode($_POST["Hotel"]);           
            $BookingTicket->Phone               = $_POST["Phone"];
            $BookingTicket->BTDate              = $_POST["BTDate"];
            $BookingTicket->BTTime              = $_POST["BTTime"];
            $BookingTicket->TypeId              = $_POST["TypeId"];
//          $BookingTicket->Departure           = $_POST["Departure"];
            $BookingTicket->DFlightNo           = $_POST["DFlightNo"];
/*          $BookingTicket->Arrival             = $_POST["Arrival"];
            $BookingTicket->AFlightNo           = $_POST["AFlightNo"];*/
            $BookingTicket->PAX                 = intval($_POST["PAX"],10);
            $BookingTicket->Price               = floatval($_POST["Price"]);
            $BookingTicket->StatusId            = $_POST["StatusId"];
            $BookingTicket->Passport            = $_POST["Passport"];
            $BookingTicket->destination         = $_POST['destination'];
            $BookingTicket->origin              = $_POST['origin'];
            $BookingTicket->transfer             = $_POST['transfer'];
            $BookingTicket->observation         = $_POST['observation'];
           // $BookingTicket->provision           = $_POST['provision'];
            $BookingTicket->user_id             = Auth::user()->id;
            $BookingTicket->save();
        }
        else
        {
            $BookingTicket = BookingTicket::create([
                'BTicketId'                 => $_GET["BTicketId"],
                'BTicketRef'                => str_replace(' ', '', strtoupper($_POST["BTicketRef"])),
                'Name'                      => urldecode($_POST["Name"]),
                'Hotel'                     => urldecode($_POST["Hotel"]),                  
                'Phone'                     => $_POST["Phone"],
                'BTDate'                    => $_POST["BTDate"],
                'BTTime'                    => $_POST["BTTime"],
                'TypeId'                    => $_POST["TypeId"],
//              'Departure'                 => $_POST["Departure"],
                'DFlightNo'                 => $_POST["DFlightNo"],
/*              'Arrival'                   => $_POST["Arrival"],
                'AFlightNo'                 => $_POST["AFlightNo"],*/
                'PAX'                       => intval($_POST["PAX"],10),
                'Price'                     => floatval($_POST["Price"]),
                'StatusId'                  => $_POST["StatusId"],
                'Passport'                  => $_POST["Passport"],
                'destination'         => $_POST['destination'],
                'origin'              => $_POST['origin'],
                'transfer'             => $_POST['transfer'],
                'observation'         => $_POST['observation'],
                'user_id'                   => Auth::user()->id
            ]);
        }
        $areas = Area::get(); 
        if(!$Error)
        {
            $BookingTicket = BookingTicket::where('BTicketId', $_GET["BTicketId"])->first();
            $BookingTicket->Status = $this->Statuses[$BookingTicket->StatusId];
            $BookingTicket->Type = $this->Types[$BookingTicket->TypeId];
            $Out["ItsOk"] = "Y";
            $Out["Html"] = view('BookingTickets/show', [
                    "BookingTicket" => $BookingTicket,
                    "Statuses"      => $this->Statuses,
                    "areas" => $areas
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
        if($BookingTicket = BookingTicket::where('id', $BTicketId)->first())
        {
            $pdf = \PDF::loadView('pdf.'.env('TICKET_TEMPLATE', 'itt'), [
                        "BookingTicket" => $BookingTicket,
            ]);
            $out = $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream();
        }
        //return view('pdf.'.env('TICKET_TEMPLATE', 'itt'), ["BookingTicket" => $BookingTicket,]);
        // \Mail::to(env('MAIL_TO_ADDRESS', 'eperez@openfenix.com'))
        //     ->send((new \App\Mail\Plantilla([]))
        //                 ->attachData($pdf->output(), 'booking.pdf')
        //                 ->subject('Nuevo ticket'));

       
        return $out;
    }

    public function viewinvoice(Request $request)
    {
        $id = $request->id;
        $data = BookingTicket::where('id', $id)->get();
        
        if(count($data) != 0)
        {
            $customer = DB::table('users')->where('name', $data[0]->Name)->get();
                return view('BookingTickets.invoice', ['data'=>$data, 'customer'=>$customer]);
        
        }
        else
        {
            return back()->with('error', 'true');
        }
    }

}
