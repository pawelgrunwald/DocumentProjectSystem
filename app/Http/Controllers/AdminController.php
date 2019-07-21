<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Repositories\UserRepository;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
}
