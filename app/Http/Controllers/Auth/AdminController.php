<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
        // $this->middleware('guest:admin');
    }

    public function index(){
        return view('Admins.dashboard-home');
    }
}
