<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\BookingTicket;

use App\User;

use App\Area;   

use Carbon\Carbon;

use Session;

use App\Bus;

use  App\CheckMangement;



class BookingController extends Controller

{

    //



    public $Statuses = [

            "P"=>"Pendiente",

            

            "E"=>"Enviad",

         

    ]; 



    public $Types = [

            "A"=>"Traslado",
	    "D" => "Disposicion",
	    "L" => "Legada",
	    "S" => "Salida",
	   

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

            

           

        }       

        $Estados["0"] = "Todos los estados";

        foreach ($this->Statuses as $key => $value)

            $Estados[$key] = $value;



        $areas = Area::get();    

        $cars  = Bus::get();
	$allStatus = false;
        $userId = Auth::user()->id;
        $check = CheckMangement::where('user_id', $userId)
                                ->where('deleted_at', NULL);
        $booking = BookingTicket::where('user_id', $userId)
                                ->where('deleted_at',NULL);
        if($check->count() == $booking->count())
        {
            $allStatus = true;
            
            
        }
    	return view('BookingTickets.booking', [ 'values' => $tickets,

                                                'BookingTickets'   => $BookingTickets,

                                                'BookingTickets2'   => $BookingTickets2,

                                                "Estados"   => $Estados,

                                                "StatusId"  => $filter,

                                                "search"    => $search,

                                                "order"     => $order,

                                                'areas' => $areas,

                                                'buses'  => $cars,
						'allStatus' => $allStatus    ]);

    	//echo "you are logged in";

    }



    public function indexB()

    {

        $data = $this->getListTicket();



        return view('BookingTickets.booking', ['BookingTickets' => $data]);

    }





    public function getListTicket()

    {

        $role = Auth::user()->role;

        $userid = Auth::user()->id;

        

        switch($role)

        {

            case 1:

                $results = BookingTicket::leftJoin('users', 'booking_tickets.user_id', '=', 'users.id')

                                              ->leftJoin('checkmangements',function ($join) use ($userid) {

                                                   $join->on('booking_tickets.id', '=' , 'checkmangements.bookingticket_id') ;

                                                   $join->where('checkmangements.user_id','=', $userid) ;

                                                  

                                                })

                                              ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')

                                              ->select('users.name', 'booking_tickets.*', 'checkmangements.id as checkstatus', 'buses.carnumber')

                                              ->latest()

                                              ->orderby('booking_tickets.Name')

                                              ->get(); 

                break;

            case 2:

                $results = BookingTicket::leftJoin('users', 'booking_tickets.user_id', '=', 'users.id')

                                          ->leftJoin('checkmangements',function ($join) use ($userid){

                                                   $join->on('booking_tickets.id', '=' , 'checkmangements.bookingticket_id') ;

                                                   $join->where('checkmangements.user_id','=', $userid) ;

                                                })

                                           ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')

                                            ->select('users.name', 'booking_tickets.*', 'checkmangements.id as checkstatus', 'buses.carnumber')

                                          ->where('booking_tickets.user_id', $userid)

                                          ->select('users.name', 'booking_tickets.*', 'checkmangements.id as checkstatus')

                                          ->latest()

                                          ->orderby('booking_tickets.Name')

                                          ->get(); 



                break;

            case 3:

                

                // $results = BookingTicket::where('user_id', $userid)

                //                     ->latest()

                //                     ->orderby('name')

                //                     ->get();

                $results = [];                

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

            $BookingTicket->BTicketId = uniqid();

            $BookingTicket->BTicketRef          = str_replace(' ', '', strtoupper($request->BTicketRef));

            $BookingTicket->Name                = urldecode($request->Name);

            $BookingTicket->Hotel               = urldecode($request->Hotel);           

            $BookingTicket->Phone               = $request->Phone;

            $BookingTicket->BTDate              = $request->BTDate;

            $BookingTicket->BTTime              = $request->BTTime;

            $BookingTicket->TypeId              = $request->TypeId;

//          $BookingTicket->Departure           = $_POST["Departure"];

            $BookingTicket->DFlightNo           = $request->DFlightNo;

/*          $BookingTicket->Arrival             = $_POST["Arrival"];

            $BookingTicket->AFlightNo           = $_POST["AFlightNo"];*/

            $BookingTicket->PAX                 = intval($request->PAX);

            $BookingTicket->Price               = floatval($request->Price);

            $BookingTicket->StatusId            = $request->StatusId;

            $BookingTicket->Passport            = $request->Passport;

            $BookingTicket->destination         = $request->destination;

            $BookingTicket->origin              = $request->origin;

           // $BookingTicket->transfer             = $_POST['transfer'];

            $BookingTicket->observation         = $request->observation;

           // $BookingTicket->provision           = $_POST['provision'];

            $BookingTicket->user_id             = Auth::user()->id;

            // $BookingTicket->invoicelanguage     = $request->invoicelanguage;

            $BookingTicket->extra = $request->extra;

            

            $BookingTicket->bus_id = $request->scar;
	      $BookingTicket->sd = $request->servicetype;

            $BookingTicket->save();

            session()->flash('success', 'true');

            return response()->json(["success"=> "true"]);

    }



    public function show()

    { 

      


        if(($_GET["BTicketId"]== "")

            ||(!$BookingTicket =BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')

                                        ->where('BTicketId', $_GET["BTicketId"])

                                        ->select('buses.carnumber as carnumber', 'booking_tickets.*')

                                        ->first()))

        {

            $BookingTicket                      =  (object) [];

            $BookingTicket->BTicketId           = uniqid();

            $BookingTicket->BTicketRef          = "";

            $BookingTicket->Name                = "";

            $BookingTicket->Hotel               = "";

            //$BookingTicket->StatusId            = "p";

            // $BookingTicket->invoicelanguage     = "sp";

             

        }



       

       // $BookingTicket->destination = $BookingTicket->destination;

       // $BookingTicket->Status = $BookingTicket->StatusId;

       // $BookingTicket->Type = $BookingTicket->TypeId;

        $areas = Area::get(); 

        $cars  = Bus::get();

        







        return view('BookingTickets/show', [

                "BookingTicket" => $BookingTicket,

                'areas' => $areas,

                'cars' => $cars   

        ]);     

    }

        

    

    // legacy code

    public function edit(Request $request)

    {

        $cars = Bus::get();

        if(($_GET["BTicketId"]== "")

            ||(!$BookingTicket = BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                        ->where('BTicketId', $_GET["BTicketId"])
                                        ->select('buses.carnumber as carnumber', 'booking_tickets.*')->first()))

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

            $BookingTicket->BTTime              = $this->getCurrentTime();

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

          //  $BookingTicket->transfer            = "";

            $BookingTicket->origin              = "";

            $BookingTicket->observation         = "";

            $BookingTicket->provision           = "";

            $BookingTicket->destination        = "";

            $BookingTicket->invoicelanguage    =  "sp"; 

            $BookingTicket->extra              = "";

            $BookingTicket->bus_id             = $this->getCurBusId();

            $BookingTicket->sd         = "";

        }

        $users = User::where("role", 3)->get();

        $areas = Area::get();  

        $cars  = Bus::get();             

        return view('BookingTickets/edit', [

                "BookingTicket" => $BookingTicket,

                "Statuses"=>$this->Statuses,

                "Types"=>$this->Types,

                "users" => $users,

                "areas" => $areas,

                "cars" => $cars              

        ]);     

    }



    public function editAjax(Request $request)

    {

        $BookingTicket = BookingTicket::where('BTicketId', $request->id)->first();

        $areas = Area::get();  

        $cars = Bus::get();

        $Ticket = BookingTicket::whereRaw('id = (select max(`id`) from booking_tickets)')->first();

        if($Ticket)

            $BTicketRef = $Ticket->id+2;

        else

            $BTicketRef = 1;



       return response()->json([ 'BookingTickets'   => $BookingTicket,

                                 'areas' => $areas,

                                 'BTicketRef'=> $BTicketRef,

                                 'cars' => $cars   ]);

    }

        

    public function existClient($name)

    {

        $user = User::where('name', $name)->count();



        if($user == 0)

        {

            return false;

        }

        else

        {

            return true;

        }

    }







    public function save(Request $request)

    {

        // if($this->existClient($request->Name))

        // {



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

                //  $BookingTicket->StatusId            = $_POST["StatusId"];

                $BookingTicket->Passport            = $_POST["Passport"];

                $BookingTicket->destination         = $_POST['destination'];

                $BookingTicket->origin              = $_POST['origin'];

                // $BookingTicket->transfer             = $_POST['transfer'];

                $BookingTicket->observation         = $_POST['observation'];

                // $BookingTicket->provision           = $_POST['provision'];

                $BookingTicket->bus_id              =    $_POST['car'];

                $BookingTicket->user_id             = Auth::user()->id;

                //    $BookingTicket->invoicelanguage     = $request->invoicelanguage;

                $BookingTicket->extra = $request->extra;

                $BookingTicket->sd = $request->servicetype;
		
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

                //    'StatusId'                  => $_POST["StatusId"],

                    'Passport'                  => $_POST["Passport"],

                    'destination'         => $_POST['destination'],

                    'origin'              => $_POST['origin'],

                    // 'transfer'             => $_POST['transfer'],

                    'observation'         => $_POST['observation'],

                    'user_id'                   => Auth::user()->id,

                    // 'invoicelanguage'     => $request->invoicelanguage,

                    'extra' => $request->extra,

                    'bus_id' => $request->car,

                    'sd' => $request->servicetype,

                ]);

            }

            $areas = Area::get(); 

            if(!$Error)

            {

                $BookingTicket = BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')

                                        ->where('booking_tickets.BTicketId', $_GET["BTicketId"])

                                        ->select('buses.carnumber as carnumber', 'booking_tickets.*')->first();

                

                $BookingTicket->Type = $this->Types[$BookingTicket->TypeId];

                $Out["ItsOk"] = "Y";

                $Out["Html"] = view('BookingTickets/show', [

                        "BookingTicket" => $BookingTicket,

                        "areas" => $areas

                ])->render();

            }

            else 

            {

                $Out["ItsOk"] = "N";

                $Out["Html"] = "Error";

            }

            return $Out;

        // }

        // else

        // {

        //     $Out["ItsOk"] = "N";

        //     $Out["Html"] = "emptyuser";



        //     return $Out;

        // }

    }

    

    

    public function PdfTicket($BTicketId)

    {

        $out = false;



        if($BookingTicket = BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
						->where('booking_tickets.id', $BTicketId)
						->select('buses.carnumber as carname', 'booking_tickets.*')->first())

        {

            // if($BookingTicket->invoicelanguage == 'en')

            // {

            //     $pdf = \PDF::loadView('pdf.'.env('TICKET_TEMPLATE_EN', 'itt_en'), [

            //             "BookingTicket" => $BookingTicket,

            //     ]);

            // }

            // else

            // {

            //     $pdf = \PDF::loadView('pdf.'.env('TICKET_TEMPLATE', 'itt'), [

            //             "BookingTicket" => $BookingTicket,

            //     ]);    

            // }

            

            $pdf = \PDF::loadView('pdf.'.env('TICKET_TEMPLATE_EN', 'itt_en'), [

             

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

        $data = BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                        ->where('booking_tickets.id', $id)
					->select('buses.carnumber as carnumber', 'booking_tickets.*')->get();

        

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



    public function getCurrentTime()

    {

        $current = Carbon::now();

        $dt      = Carbon::now();



      //  $dt = $dt->subHours(2);

        $dt = $dt->subHours(1);

        $current_timestamp = $dt->timestamp;

        $time = Date("H:i", $current_timestamp);

       

        return $time;

        //return $time;

    }





    public function setCheck(Request $request)

    {

        $userId = Auth::user()->id;

        $ticketId = $request->id;

        $data = CheckMangement::where('bookingticket_id', $ticketId)

                                ->where('user_id', $userId)

                                ->where('deleted_at', NULL);

        if($data->count() == 1)

        {

            $data->delete();

            

            return response()->json(['stauts' => 'uncheck']);

        }else

        {


            $checkmangement = new CheckMangement();

            $checkmangement->user_id = $userId;

            $checkmangement->bookingticket_id = $ticketId;

            $checkmangement->save();



            return response()->json(['status' => 'check']); 

        }

    }

     public function allCheck(Request $request)
    {
        $userId = Auth::user()->id;

        $ticketId = $request->id;

        $check = CheckMangement::where('user_id', $userId)
                                ->where('deleted_at', NULL);
        $booking = BookingTicket::where('user_id', $userId)
                                ->where('deleted_at',NULL);

        if($check->count() == $booking->count())
        {
            $check->delete();
            
            return response()->json(['stauts' => 'uncheck']);
        }else
        {
            $check->delete();
            $booking = BookingTicket::where('user_id', $userId)
                                    ->get();
            foreach($booking as $val)
            {
                $checkmangement = new CheckMangement();


                $checkmangement->user_id = $userId;
                $checkmangement->bookingticket_id = $val->id;
                $checkmangement->save();    
            }
            

            return response()->json(['status' => 'check']); 
        }
    }


    public function search(Request $request)

    {





        if($request->ajax()) {

            // select country name from database

            $data = BookingTicket::where('BTicketRef', 'like', '%'.$request->keyword.'%')

                                    ->orWhere('Hotel', 'like', '%'.$request->keyword.'%')

                                    ->orWhere('Name', 'like', '%'.$request->keyword.'%')

                                    ->orWhere('Passport', 'like', '%'.$request->keyword.'%')

                                    ->orWhere('Phone', 'like', '%'.$request->keyword.'%')

                                    ->orWhere('BTDate', 'like', '%'.$request->keyword.'%')

                                    ->latest()

                                    ->orderby('booking_tickets.Name')

                                    ->get(); 

            // declare an empty array for output

            $output = '';

            // if searched countries count is larager than zero

            if (count($data)>0) {

                // concatenate output to the array

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

                // loop through the result array

                foreach ($data as $row){

                    // concatenate output to the array

                    $output .= '<li class="list-group-item">'." ".$row['BTTimeTicketRef']."".$row['Name']." ".$row['Hotel']." ".$row['Phone']." ".$row['Passport'].'</li><input type="hidden" class="BTicketId" value="'.$row['BTicketId'].'">';

                } 

                // end of output

                $output .= '</ul>';

            }

            else {

                // if there's no matching results according to the input

                $output .= '<li class="list-group-item">'.'No results'.'</li>';

            }

            // return output result array

            return $output;

        }



       

    }







    public function getCurBusId()

    {

        

        $bookingTicket = BookingTicket::latest()->first();





        $lastBustId = $bookingTicket->bus_id;



        $cars = Bus::get();

        if($cars->count() == 0)

        {

            $result = 0;

        }

        else

        {

            $result = $cars[0]->id;

        }

        



        for($i = 0 ; $i < count($cars); $i++)

        {

            if($cars[$i]->id == $lastBustId)

            {

                if($i != (count($cars)-1))

                {

                    $result = $cars[$i+1]->id;

                }            

            }

        }



        return $result;

    }

}

