<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;
use App\Repositories\UserRepository;

class UserController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
    }

    public function myAccount(UserRepository $userRepo, $name) {

    	if (Auth::user()->type != 'user' && Auth::user()->type != 'admin') {
			return redirect()->route('login');
		}

    	$userData = array('name' => Auth::user()->name,  'lastname' => Auth::user()->lastname,'email' => Auth::user()->email, 'type' => Auth::user()->type);

    	return view('users.account', ['userData' => $userData]);
    }


}
