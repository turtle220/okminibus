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
class CarController extends Controller
{
    //
    public function __construct()
    {
    	//$this->middleware('auth');
    }


    public function index()
    {}
    /**
     *  car infore save function 
     *  
     **/
    public function store(Request $request)
    {
    	$car = new Bus;
    	$car->carnumber = $request->carnumber;
    	$car->carname = $request->carname;
 		$car->user_id = Auth::user()->id;
    	$result= $car->save();
    	$car = Bus::latest()->first();

    	$id = $car->id;
    	$car = $car->carnumber;

    	if($result  == 0)
    	{
    		return response()->json(['success' => "false"]);
    	}
    	else
    	{
    		return response()->json(['success' => "true", "id" => $id, "carnumber" => $car]);
    	}

    }
}
