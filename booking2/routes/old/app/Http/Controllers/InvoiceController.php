<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\BookingTicket;
use App\User;
use PDF;

class InvoiceController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$user = Auth::user();

		if(isset($request->username)&&$request->username != '0')
		{
			
			$username = $request->username;
			$data = $this->getTickets($username);
		}
		else
		{
			$data = $this->getTickets('0');
		}


		if($user->role == 1)
		{
			$users = DB::table('booking_tickets')->groupBy('Name')->get();
		}
		else
		{
			$users = BookingTicket::where('user_id', $user->id)->groupBy('Name')->get();
		}
		// var_dump($request->username);
		// echo "<br>";
		// return $users;
		return view('invoice.invoice', ['values'  => $data,
										'users'   => $users,
										'curuser' => $request->username ]);
		
	}

	public function getTickets($username)
	{
		$user = Auth::user();
		if($username == '0')
		{

		   if($user->role == 1)
		   {
		 		$results = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
		 											  ->select('users.name', 'booking_tickets.*')
		 											  ->get();  		
		   }
		   else if($user->role == 2)
		   {
		   		$results = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
		 											   ->select('users.name', 'booking_tickets.*')
		   											   ->where('booking_tickets.user_id',  $user->id)
		   											   ->latest()
		   											   ->get();
		   }
		}
		else
		{
		   if($user->role == 1)
		   {
		   		$results = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
		 											  ->select('users.name', 'booking_tickets.*')
		 											  ->where('booking_tickets.Name', $username)
		 											  ->latest()
		 											  ->get();
		   }
		   else if($user->role == 2)
		   {
				$results = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
		 											   ->select('users.name', 'booking_tickets.*')
													   ->where('booking_tickets.Name', $username)
													   ->latest()
													   ->get();

		   }
		}

	   
		return $results;

	}

	public function edit(Request $request)
	{
		$id = $request->id;

		$data = BookingTicket::where('id', $id)->get();
		$users = User::where('role', 3)->get();//get only user.
		$curUser = User::where('name', $data[0]->name)->get();

		return view('invoice.editinvoice', ['value' => $data,
											'users' => $users,
											'customer' => $curUser]);	
	}

	public function update(Request $request)
	{
		
		$id = $request->id;

		$bookingTicket = BookingTicket::find($id);

		//$bookingTicket->Price = $request->Price; 
		$bookingTicket->Hotel = $request->Hotel;
		//$bookingTicket->Name  = $request->Name;
		$bookingTicket->BTDate = $request->BTDate;
		$bookingTicket->BTTime = $request->BTTime;
		$bookingTicket->DFlightNo =  $request->DFlightNo;
		$bookingTicket->transfer = $request->transfer;
		$bookingTicket->origin =  $request->origin;
		$bookingTicket->destination = $request->Hotel;

		$bookingTicket->Price = str_replace(' ', '', $request->price);
		$bookingTicket->observation = str_replace(' ', '', $request->observation) ;
		$bookingTicket->save();

		$data = BookingTicket::where('id', $id)->get();

        if(count($data) != 0)
        {
            $customer = DB::table('users')->where('name', $data[0]->Name)->get();
            
            
            return view('BookingTickets.invoice', ['data'=>$data]);
        	
        }
        else
        {
        	
            return redirect('/invoice')->with('error', 'true');
        }

		// 	

	}



	public function invoiceToPdf(Request $request)
	{
		// Fetch all customers from database
		$id = $request->id;
        $data = BookingTicket::where('id', $id)->get();
        
        if(count($data) != 0)
        {
            $customer = DB::table('users')->where('name', $data[0]->Name)->get();
        }
	    // Send data to the view using loadView function of PDF facade
	    $pdf = PDF::loadView('pdf.invoice',['data' => $data] );
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
			if($name==""||$name== '0')
			{
				$data = DB::table('booking_tickets')->latest()
													->get();
				
			}
			else
			{
				$data = DB::table('booking_tickets')->where('Name', $name)
													 ->latest()
													 ->get();
				
			}


		}
		else
		{
			$user = Auth::user();
			if($name==""||$name==0)
			{
				$data = DB::table('booking_tickets')->where('user_id', $user->id)
				 					 				->latest()
				 									->get();
			}
			else
			{
				$data = DB::table('booking_tickets')->where('user_id', $user->id)
													 ->where('Name', $name)
													 ->latest()
													 ->get();
			}
		}
		
		//return $data;
		$pdf = PDF::loadView('pdf.invoicelist',['data' => $data]);
		$out = $pdf->setPaper('a4', 'portrait')->setWarnings(false)->stream();


		$pdf->save(storage_path().'_filename.pdf');
				return $pdf->download('invoice.pdf');
		
		//return view('pdf.invoicelist', ['data' => $data]);
	}
	

	public function viewinvoice($id)
    {
        $data = BookingTicket::where('id', $id)->get();
        if(count($data) != 0)
        {
            $customer = DB::table('users')->where('name', $data[0]->Name)->get();


            return view('BookingTickets.invoice', ['data'=>$data]);
        	
        }
        else
        {
        	echo "h";
            return back()->with('error', 'true');
        }
    }
}
