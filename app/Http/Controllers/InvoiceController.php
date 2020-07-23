<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\BookingTicket;
use App\User;
use PDF;
use App\Bus;
class InvoiceController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$request->flash();
		$user = Auth::user();

		if(isset($request->username)&&$request->username != '0'){

			$username = $request->username;
			$from = $request->from;
			$to = $request->to;
			$data = $this->getTickets($username, $from, $to);
			
		}
		else{

			$from = $request->from;
			$to = $request->to;
			$data = $this->getTickets('0', $from, $to);
			
		}
	
		if($user->role == 1){
			$users = DB::table('booking_tickets')->groupBy('Name')->get();
		}
		else{
			$users = BookingTicket::where('user_id', $user->id)->groupBy('Name')->get();
		}

		$allStatus = false;
		$userId = Auth::user()->id;
		$check = DB::table('checkinvoices')->where('user_id', $userId)
											->where('deleted_at',NULL);
																			
		$booking = DB::table('booking_tickets')->where('user_id', $userId)
											->where('deleted_at',NULL);

		if($check->count() == $booking->count()){
			$allStatus = false;
	
		}
		return view('invoice.invoice', ['values'  => $data,
										'users'   => $users,
										'curuser' => $request->username ,
										'allStatus' => $allStatus
										]);
	}

	public function getTickets($username, $from, $to)
	{
		
		$user = Auth::user();
		$userid = Auth::user()->id;
		if(isset($from) && isset($to)){
			if($username == '0'){
				if($user->role == 2 || $user->role == 1){
					$results = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
															->leftJoin('checkinvoices',function ($join) use ($userid) {
																$join->on('booking_tickets.id', '=' , 'checkinvoices.invoice_id') ;
																$join->where('checkinvoices.user_id','=', $userid) ;
															})
															->select('users.name', 'booking_tickets.*', 'checkinvoices.id as checkstatus')
															->where('booking_tickets.user_id',  $userid)
															->whereDate('booking_tickets.created_at','<=', $to)
															->whereDate('booking_tickets.created_at', '>=', $from)
															->latest()
															->get();
				}
			}
			else{
				if($user->role == 2 || $user->role == 1){
					$results = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
															->leftJoin('checkmangements',function ($join) use ($userid){
																$join->on('booking_tickets.id', '=' , 'checkmangements.bookingticket_id') ;
																$join->where('checkmangements.user_id','=', $userid) ;

															})
															->select('users.name', 'booking_tickets.*', 'checkmangements.id as checkstatus')
															->where('booking_tickets.Name', $username)
															->whereDate('booking_tickets.created_at','<=', $to)
															->whereDate('booking_tickets.created_at', '>=', $from)
															->latest()
															->get();
				}
			}
		} else{
			if($username == '0'){ 
				if($user->role == 2 || $user->role == 1){
					$results = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
															->leftJoin('checkinvoices',function ($join) use ($userid) {
																$join->on('booking_tickets.id', '=' , 'checkinvoices.invoice_id') ;
																$join->where('checkinvoices.user_id','=', $userid) ;

															})
															->select('users.name', 'booking_tickets.*', 'checkinvoices.id as checkstatus')
															->where('booking_tickets.user_id',  $userid)
															->latest()
															->get();
				}
			}
			else{
				if($user->role == 2 || $user->role == 1){
					$results = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
															->leftJoin('checkmangements',function ($join) use ($userid){
																$join->on('booking_tickets.id', '=' , 'checkmangements.bookingticket_id') ;
																$join->where('checkmangements.user_id','=', $userid) ;

															})
															->select('users.name', 'booking_tickets.*', 'checkmangements.id as checkstatus')
															->where('booking_tickets.Name', $username)
															->latest()
															->get();
				}
			}
		}
		
		return $results;
	}

	public function edit(Request $request)
	{
		$id = $request->id;

		$data = BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
			->where('booking_tickets.id', $id)
			->select('buses.carnumber as carnumber', 'booking_tickets.*')->get();

		//get only user.
		$users = User::where('role', 3)->get();
		
		$curUser = User::where('name', $data[0]->name)->get();
		
		return view('invoice.editinvoice', ['value' => $data,
											'users' => $users,
											'customer' => $curUser]);	
	}

	public function getBusId($carnumber)
	{
		return Bus::where('carnumber', 'like', '%'.$carnumber.'%')->first()->id;
	}

	public function update(Request $request)
	{
		
		$id = $request->id;

		$bookingTicket = BookingTicket::find($id);

		$bookingTicket->TypeId = $request->type; 
		$bookingTicket->Hotel = $request->Hotel;
		$bookingTicket->BTDate = $request->BTDate;
		$bookingTicket->BTTime = $request->BTTime;
		$bookingTicket->Name = $request->Name;
		$bookingTicket->Passport = $request->passport;
		$bookingTicket->transfer = $request->transfer;
		$bookingTicket->origin =  $request->origin;
		$bookingTicket->destination = $request->destination;
		$bookingTicket->bus_id = $this->getBusId($request->carnumber);
		$bookingTicket->Price = str_replace(' ', '', $request->price);
		$bookingTicket->observation = str_replace(' ', '', $request->observation) ;
		$bookingTicket->save();

		$data = BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                        ->where('booking_tickets.id', $id)
                                        ->select('buses.carnumber as carnumber', 'booking_tickets.*')->get();

        if(count($data) != 0)
        {
            $customer = DB::table('users')->get();
            
            return view('BookingTickets.invoice', ['data'=>$data]);
        }
        else
        {
            return redirect('/invoice')->with('error', 'true');
        }
	}

	public function invoiceToPdf(Request $request)
	{
		// Fetch all customers from database
		$id = $request->id;
        $data = BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                        ->where('booking_tickets.id', $id)->get();

		$invoice = 'invoice';
        if(count($data) != 0)
        {
            $customer = DB::table('users')->where('name', $data[0]->Name)->get();
        }

	    // Send data to the view using loadView function of PDF facade
	    $pdf = PDF::loadView('pdf.'.$invoice, ['data' => $data] );
	    $out = $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream();
	    // If you want to store the generated pdf to the server then you can use the store function
	    $pdf->save(storage_path().'_filename.pdf');
	    // Finally, you can download the file using download function
	    //return $pdf->download($customer[0]->name.'.pdf');
	    return $pdf->download('invoice.pdf');
	}

	public function invoicelistToPdf(Request $request)
	{
		$name = $request->name;

		if(Auth::user()->role == 1)
		{
		
            $userId = $user->id;

            $checkinvoices = DB::table('checkinvoices')->where('user_id', $userId);

            $checkedDatas   =  $checkinvoices->get();
        
            $checkinvoices->delete();                                
        
            $ids = [];
                                      
            foreach($checkedDatas as $val)
        
			   array_push($ids, $val->invoice_id);
			   
			if($name==""||$name== '0'){
                $data = DB::table('booking_tickets')->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
													->where('booking_tickets.user_id', $user->id)
													->whereIn('booking_tickets.id', $ids)
													->select('booking_tickets.*', 'buses.carnumber', 'buses.carname')
													->get();
			}
			else{
                $data = DB::table('booking_tickets')->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
													->where('booking_tickets.user_id', $user->id)
													->where('Name', $name)
													->select('booking_tickets.*', 'buses.carnumber', 'buses.carname')
													->get();
			}
			
			$pdf = PDF::loadView('pdf.invoicelist',['data' => $data]);
			$out = $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream();
			$pdf->save(storage_path().'_filename.pdf');
					
			return $pdf->download('invoice.pdf');

		}
		else{
			$user = Auth::user();
            $userId = $user->id;

            $checkinvoices = DB::table('checkinvoices')->where('user_id', $userId);

            $checkedDatas   =  $checkinvoices->get();
        
            $checkinvoices->delete();                                
        
            $ids = [];
                                      
            foreach($checkedDatas as $val)
        
               array_push($ids, $val->invoice_id);
			
			if($name==""||$name==0){
				$data = DB::table('booking_tickets')->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
													->where('booking_tickets.user_id', $user->id)
													->whereIn('booking_tickets.id', $ids)
													->select('booking_tickets.*', 'buses.carnumber', 'buses.carname')
													->get();
			}
			else{
                $data = DB::table('booking_tickets')->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
													->where('booking_tickets.user_id', $user->id)
													->where('Name', $name)
													->select('booking_tickets.*', 'buses.carnumber', 'buses.carname')
													->get();
			}
		}
	
		$pdf = PDF::loadView('pdf.invoicelist',['data' => $data]);
		$out = $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream();
		$pdf->save(storage_path().'_filename.pdf');
				
		return $pdf->download('invoice.pdf');
		//return view('pdf.invoicelist', ['data' => $data]);
	}

	public function viewinvoice($id)
    {
        $data = BookingTicket::leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
								->where('booking_tickets.id', $id)
								->select('buses.carnumber as carnumber', 'booking_tickets.*')->get();
        if(count($data) != 0){
            $customer = DB::table('users')->where('name', $data[0]->Name)->get();

            return view('BookingTickets.invoice', ['data'=>$data]);
        }
        else{
        	echo "h";
            return back()->with('error', 'true');
        }
	}
	
	public function setCheck_invoice(Request $request)

    {
        $userId = Auth::user()->id;

        $ticketId = $request->id;

        $data = DB::table('checkinvoices')->where('invoice_id', $ticketId)
										->where('user_id', $userId)
										->where('deleted_at', NULL);

        if($data->count() == 1){
            $data->delete();

            return response()->json(['stauts' => 'uncheck']);
        }else{
			$ticketId = $request->id;		
			$checkinvoice =DB::table('checkinvoices')->insert([
				'user_id' => $userId,
				'invoice_id' => $ticketId
			]);
		   
			return response()->json(['status' => 'check']); 
        }
    }

	public function allCheck_invoice(Request $request)
    {
        $userId = Auth::user()->id;
		$from = $request->from;
		$to = $request->to;
        $ticketId = $request->id;

        $check = DB::table('checkinvoices')->where('user_id', $userId)
											->where('deleted_at', NULL);

		if($from == NULL || $to == NULL){
			$booking = BookingTicket::where('user_id', $userId)
									->where('deleted_at',NULL);
			
			if($check->count() == $booking->count()){
				$check->delete();
				
				return response()->json(['stauts' => 'uncheck']);
			}else{

				$check->delete();
				$booking = BookingTicket::where('user_id', $userId)
										->get();
				foreach($booking as $val)
				{
					$checkinvoice =DB::table('checkinvoices')->insert([
						'user_id' => $userId,
						'invoice_id' => $val->id
					]);
				}

				return response()->json(['status' => 'check']); 
			}
		}else{
			$booking = BookingTicket::where('user_id', $userId)
									->whereDate('booking_tickets.created_at','<=', $to)
									->whereDate('booking_tickets.created_at', '>=', $from)
									->where('deleted_at',NULL);

			if($check->count() == $booking->count()){
				
				$check->delete();
				return response()->json(['stauts' => 'uncheck']);

			}else{
				$check->delete();
				$booking = BookingTicket::where('user_id', $userId)
									->whereDate('booking_tickets.created_at','<=', $to)
									->whereDate('booking_tickets.created_at', '>=', $from)
									->get();

				foreach($booking as $val)
				{
					$checkinvoice =DB::table('checkinvoices')->insert([
						'user_id' => $userId,
						'invoice_id' => $val->id
					]);
				}
				return response()->json(['status' => 'check']); 
			}
		}
    }
}