<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\BookingTicket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function __construct()
    {
		//admin, auth middleware in route
		$this->middleware(['auth', 'admin']);
	}

	public function index()
	{
		$users = $this->getUserList();

		return view('userview.user',['values' => $users]);
	}

	public function create()
	{

		return view('userview.usercreate');
	}

	public function store(Request $request)
	{
		$request->validate([
					'name' => 'required|string|max:255|unique:users',
		            'firstname' => 'required|string|max:255',
		            'lastname' => 'required|string|max:255',
		            'email' => 'required|string|email|max:255|unique:users',
					'password' => 'required|string|min:8|confirmed'
		]);

		$user = new User;

		$user->name = $request->name;
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->email = $request->email;
		$user->password =  Hash::make($request->password);
		$user->save();

		return  redirect('/users')->with('success', 'true');
	}

	public function getUserList()
	{
		$users = DB::table('users')->orderBy('role')
								  ->orderBy('name')
								  ->whereNull('deleted_at')
								  ->get();

		return $users;
	}


	public function getUserListAjax(Request $request)
	{
		$users = DB::table('users')->where('name', "like", $request->term.'%')
								  //->where('user_role', 3)
								  ->orderBy('role')
								  ->orderBy('name')
								  ->whereNull('deleted_at')
								  ->select('name')
								  ->get();

		$names = [];
		foreach ($users as $val) {
			# code...
			array_push($names, $val->name);
		}

		return json_encode($names);
		//return response()->json(['users' => $users]);
	}

	public function edit(Request $request)
	{
		$id = $request->userId;

		$user = User::find($id)->get();

		
		return view('userview.useredit', ['value' => $user]);
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$request->validate([
			'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
		]);


		$user = User::find($id);

		$user->name = $request->name;
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->email = $request->email;

		$user->save();

		return redirect('/users')->with('success', 'true');
	}

	public function destroy(Request $request)
	{
		$id = $request->userId;

		$user = User::find($id);



		$user->delete();

		return back()->with('success', 'true');
	}

	public function setRole(Request $request)
	{
		$id = $request->id;

		$role = $request->role;
		
		$user =  User::find($id);
		
		$user->role = $role;

		$result = $user->save();

		if($result == 0)
		{
			return response()->json(['success' => 'false']);
		}
		else
		{
			return response()->json(['success'=> 'true']);
		}
		
	}

}
