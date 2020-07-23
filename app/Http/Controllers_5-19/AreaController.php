<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\BookingTicket;
use App\User;
use App\Area;

class AreaController extends Controller
{
    //
    public function __construct() {
    	$this->middleware('auth');
    }

    public function  index()
    {}

    public function create()
    {}

    public function store(Request $request)
    {

    	$area = new Area;
    	$area->name = $request->destination;
    	$result = $area->save();

    	if($result != 0)
    	{
    		return response()->json([
    			'success' => 'true',
    			'curarea' => $request->destination
    		]);
    	}
		else  	
    	{
    		return response()->json(['success' => 'error']);
    	}


    }


    public function edit(){}

    public function update(){}

    public function destroy() {}

}
