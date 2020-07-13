<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\BookingTicket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Exports\InvoiceExcel;
use Excel;
use Carbon\Carbon;
class ExcelController extends Controller
{
    //

	public function __construct() {
		$this->middleware('auth');
	}


  public function index(Request $request) {

    $request->flash();

    $user = Auth::user();
	if($request->username == NULL)
          $request->username = 0;

        if(isset($request->from) && isset($request->to))
        {//by date

          $from = $request->from;
          $to  = $request->to;
            if($user->role == 1)
            {//admin case 
                $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                    ->select('users.name', 'booking_tickets.*')
                                                    ->whereDate('booking_tickets.created_at','<=', $to)
                                                    ->whereDate('booking_tickets.created_at', '>=', $from);
                      
                if(!empty($request->username)||$request->username != 0 )
                {
                    $data  = $data->where('booking_tickets.Name', $request->username);
                }
               
                $count = $data->count();
                $result = $data->get();

            }else
            {//employee case
                 $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                      ->select('users.name', 'booking_tickets.*')
                                                      ->whereDate('booking_tickets.created_at','<=', $to)
                                                      ->whereDate('booking_tickets.created_at', '>=', $from)
                                                      ->where('booking_tickets.user_id', Auth::user()->id);
                
                if(!empty($request->username)||$request->username != 0 )
                {    
                  $data =  $data->where('booking_tickets.Name', $request->username);

                }

                $count = $data->count();
                $result = $data->get();
            }


        }else
        {//whole data

            if($user->role == 1)
            {//admin case
              

                if($request->username == '0' )
                {
                    $result =DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                      ->select('users.name', 'booking_tickets.*')
                                                      ->get();

                    $count = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                      ->select('users.name', 'booking_tickets.*')
                                                      ->count();
                }
                else
                {

                    $result =DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                      ->select('users.name', 'booking_tickets.*')
                                                      ->where('booking_tickets.Name', $request->username)
                                                      ->get();

                    $count = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                      ->select('users.name', 'booking_tickets.*')
                                                      ->where('booking_tickets.Name', $request->username)
                                                      ->count();
                }

            }else
            {//employee acse
                $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                      ->select('users.name', 'booking_tickets.*')
                                                      ->where('booking_tickets.user_id', Auth::user()->id);
                

                if($request->username == 0 )
                {
                     $data  = $data->where('booking_tickets.Name', $request->username);
                }
               
                                    

                $count = $data->count();
                $result = $data->get();

            }
        }

        // get users name		  
        if($user->role == 1)
        {
            $users = DB::table('booking_tickets')->groupBy('Name')->get();
        }
        else
        {
            $users = BookingTicket::where('user_id', $user->id)->groupBy('Name')->get();
        }


    	return view('excel.excel', ['values' => $result, 
                                    'count' => $count,
                                    'users' => $users ]);
    }

    public function getBookingList($from, $to) {

    	

    	return $data;
    }

    //admin 
	public function printExcel(Request $request) {

    $user = Auth::user();

    if(isset($request->from) && isset($request->to))
    {//by date

      $from = $request->from;
      $to  = $request->to;
        if($user->role == 1)
        {//admin case 
            $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                ->select('users.name', 'booking_tickets.*')
                                                ->whereDate('booking_tickets.created_at','<=', $to)
                                                ->whereDate('booking_tickets.created_at', '>=', $from);
                  
            if(!empty($request->username)||$request->username != 0 )
            {
                $data  = $data->where('booking_tickets.Name', $request->username);
            }
           
            $values = $data->get();

        }else
        {//employee case
             $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                  ->select('users.name', 'booking_tickets.*')
                                                  ->whereDate('booking_tickets.created_at','<=', $to)
                                                  ->whereDate('booking_tickets.created_at', '>=', $from)
                                                  ->where('booking_tickets.user_id', Auth::user()->id);
            
            if(!empty($request->username)||$request->username != 0 )
            {    
              $data =  $data->where('booking_tickets.Name', $request->username);

            }

            $values = $data->get();
        }


    }else
    {//whole data

        if($user->role == 1)
        {//admin case
          

            if($request->username == '0' )
            {
                $values =DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                  ->select('users.name', 'booking_tickets.*')
                                                  ->get();

            }
            else
            {

                $values =DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                  ->select('users.name', 'booking_tickets.*')
                                                  ->where('booking_tickets.Name', $request->username)
                                                  ->get();

            }

        }else
        {//employee acse
            $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                  ->select('users.name', 'booking_tickets.*')
                                                  ->where('booking_tickets.user_id', Auth::user()->id);
            

            if($request->username == 0 )
            {
                 $data  = $data->where('booking_tickets.Name', $request->username);
            }
           
                                

            $values = $data->get();

        }
    }


    if(isset($request->username))
    {
      $excelname = $request->username."_".$request->from."_".$request->to."reservation";
    }
    else
    {
      $excelname = "Whole"."_".$request->from."_".$request->to."reservation";
    }

    $out = InvoiceExcel::create($excelname, function($excel) {

      $excel->sheet('New sheet', function($sheet) {

          $sheet->loadView('excel.excelprint', ['values' => $values]);

      });

    });

    // $invoiceExcel = new InvoiceExcel;
    // $invoiceExcel->getData($values);

    return $invoiceExcel->download('xls');

	}
	
	
  public function selectedPrint()
  {

    $user = Auth::user();
    $userId = $user->id;


    $checkmangement = DB::table('checkmangements')->where('user_id', $userId);
                                        
    $checkedDatas   =  $checkmangement->get();
    $checkmangement->delete();                                
    $ids = [];
    
    foreach($checkedDatas as $val)
       array_push($ids, $val->bookingticket_id);

    $values = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                          ->whereIn('booking_tickets.id', $ids)
                                          ->select('users.name', 'booking_tickets.*')
                                          ->get();

    $invoiceExcel = new InvoiceExcel;
    

    $invoiceExcel->getData($values);
    
    $date = Carbon::now();
    $date = $date->format("Y_m_d");
    $username = $user->name;

    $excelname = "Invoice_report_".$date."_".$username;
    return Excel::download($invoiceExcel, $excelname.'.xlsx');


  }
}



