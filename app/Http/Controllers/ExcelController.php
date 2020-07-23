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
	public function __construct() {

		$this->middleware('auth');

	}

  public function index(Request $request) {

    $request->flash();
    $user = Auth::user();

	if($request->username == NULL)

        $request->username = 0;

        if(isset($request->from) && isset($request->to)){
            //by date

            $from = $request->from;
            $to  = $request->to;
            if($user->role == 1){
                //admin case 

                $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                    ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                    ->whereDate('booking_tickets.created_at','<=', $to)
                                                    ->orderBy('booking_tickets.created_at', 'desc')
                                                    ->whereDate('booking_tickets.created_at', '>=', $from);

                if(!empty($request->username)||$request->username != 0 ){
                    $data  = $data->where('booking_tickets.Name', $request->username);
                }

                $count = $data->count();
                $result = $data->get();

            }else{
                //employee case

                 $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                    ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                    ->whereDate('booking_tickets.created_at','<=', $to)
                                                    ->whereDate('booking_tickets.created_at', '>=', $from)
                                                    ->orderBy('booking_tickets.created_at', 'desc')
                                                    ->where('booking_tickets.user_id', Auth::user()->id);

                if(!empty($request->username)||$request->username != 0 ){    
                  $data =  $data->where('booking_tickets.Name', $request->username);
                }

                $count = $data->count();
                $result = $data->get();
            }

        }else{//whole data



            if($user->role == 1){
                //admin case

                if($request->username == '0' ){

                    $result =DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                        ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                        ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                        ->orderBy('booking_tickets.created_at', 'asc')
                                                        ->get();

                    $count = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                        ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                        ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                        ->count();
                }

                else{

                    $result =DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                        ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                        ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                        ->where('booking_tickets.Name', $request->username)
                                                        ->orderBy('booking_tickets.created_at', 'asc')
                                                        ->get();

                    $count = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                        ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                        ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                        ->where('booking_tickets.Name', $request->username)
                                                        ->count();
                }
            }else{
                //employee acse

                $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                    ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                    ->where('booking_tickets.user_id', Auth::user()->id);

                if($request->username == 0 ){
                     $data  = $data->where('booking_tickets.Name', $request->username)
                                    ->orderBy('booking_tickets.created_at', 'desc');
                }
                $count = $data->count();
                $result = $data->get();
            }
        }
        // get users name		  
        if($user->role == 1){

            $users = DB::table('booking_tickets')->groupBy('Name')->get();

        } else{

            $users = BookingTicket::where('user_id', $user->id)->groupBy('Name')->get();

        }
        // sort($result);
    	return view('excel.excel', ['values' => $result, 
                                    'count' => $count,
                                    'users' => $users ]);
    }

    public function getBookingList($from, $to) 
    {
    	return $data;
    }

    //admin 
    public function printexcel_hoja(Request $request)
    {
    	$name = $request->name;
        $to= $request->to;
        $from = $request->from;
		if(Auth::user()->role == 1){
			if($name==""||$name== '0'){
				$data = DB::table('booking_tickets')->latest()
													->get();
			}else{
				$data = DB::table('booking_tickets')->where('Name', $name)
													 ->latest()
													 ->get();
			}
		}else{
            $user = Auth::user();
            $userId = $user->id;
       
			if($name==""||$name==0){
                $data = DB::table('booking_tickets')->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->where('booking_tickets.user_id', $user->id)
                                                    ->whereDate('booking_tickets.created_at','<=', $to)
                                                    ->whereDate('booking_tickets.created_at', '>=', $from)
                                                    ->select('booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                    ->get();
			}else{
                $data = DB::table('booking_tickets')->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->where('booking_tickets.user_id', $user->id)
                                                    ->where('Name', $name)
                                                    ->select('booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                    ->get();
            }
        }
      
		return view('excel.excelinvoicelist1',['data' => $data]);
    }

	public function printExcel(Request $request) {

    $user = Auth::user();
    $name = $request->name;

    if(isset($request->from) && isset($request->to)){
        //by date
      $from = $request->from;
      $to  = $request->to;

        if($user->role == 1){
            //admin case 
            $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                ->whereDate('booking_tickets.created_at','<=', $to)
                                                ->whereDate('booking_tickets.created_at', '>=', $from);
                  
            if(!empty($request->username)||$request->username != 0 ){
                $data  = $data->where('booking_tickets.Name', $request->username);
            }
            $values = $data->get();
        }else{
            //employee case

            $data = DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                ->whereDate('booking_tickets.created_at','<=', $to)
                                                ->whereDate('booking_tickets.created_at', '>=', $from)
                                                ->where('booking_tickets.user_id', Auth::user()->id);

            if(!empty($request->username)||$request->username != 0 ){    
              $data =  $data->where('booking_tickets.Name', $request->username);
            }
            $values = $data->get();
        }
    }else{
        //whole data

        if($user->role == 1){
            //admin case

            if($request->username == '0' ){
                $values =DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                    ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                    ->whereDate('booking_tickets.created_at','<=', $to)
                                                    ->whereDate('booking_tickets.created_at', '>=', $from)
                                                    ->get();
            }else{

                $values =DB::table('booking_tickets')->join('users', 'booking_tickets.user_id', '=', 'users.id')
                                                    ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                    ->whereDate('booking_tickets.created_at','<=', $to)
                                                    ->whereDate('booking_tickets.created_at', '>=', $from)
                                                    ->where('booking_tickets.Name', $request->username)
                                                    ->get();
            }
        }else{
            //employee acse
                $data = DB::table('booking_tickets')->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->where('booking_tickets.user_id', $user->id)
                                                    ->where('Name', $name)
                                                    ->select('booking_tickets.*', 'buses.carnumber', 'buses.carname');
                
                if($request->username == 0 ){
                    $data  = $data->where('booking_tickets.Name', $request->username);
                }
                $values = $data->get();
            }
        }

        if(isset($request->username)){
            $excelname = $request->username."_".$request->from."_".$request->to."reservation";
        }else{
            $excelname = "Whole"."_".$request->from."_".$request->to."reservation";
        }

        $invoiceExcel = new InvoiceExcel;
        $invoiceExcel->getData($values);
        return Excel::download($invoiceExcel, $excelname.'.xlsx'  );

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
                                                    ->leftJoin('buses', 'booking_tickets.bus_id', '=', 'buses.id')
                                                    ->whereIn('booking_tickets.id', $ids)
                                                    ->select('users.name', 'booking_tickets.*', 'buses.carnumber', 'buses.carname')
                                                    ->get();

        $invoiceExcel = new InvoiceExcel;
        $invoiceExcel->getData($values);
        $date = Carbon::now();
        $date = $date->format("Y_m_d");
        $username = $user->name;

        $excelname = "Invoice_report_".$date."_".$username;
        return Excel::download($invoiceExcel, $excelname.'.xlsx'  );
    }

    public function invoiceListExcel(Request $request)
    {
    	$name = $request->name;

		if(Auth::user()->role == 1){
			if($name==""||$name== '0'){
				$data = DB::table('booking_tickets')->latest()
													->get();
			}
			else{
				$data = DB::table('booking_tickets')->where('Name', $name)
                                                    ->latest()
                                                    ->get();
			}
		}else{
        
            $num = DB::table('config')->get();
            foreach($num as $num_val1)
                if ($num_val1->name === 'lastUsedNum') {
                    $num_val = $num_val1->value;
                }
         
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

        $num = $num_val;
        $temp = $num_val;
        foreach($data as $val) {
            $num = $num + 1;
            $val->Num_Fac = $num;
           
            DB::table('booking_tickets')->where('booking_tickets.id', $val->id)
                                        ->update(['Num_Factura' => $num]);
        }
        
        DB::table('config')->where("name", "lastUsedNum")
                            ->update(['value' => $num]);
      
		return view('excel.excelinvoicelist',['data' => $data]);
    }
}







