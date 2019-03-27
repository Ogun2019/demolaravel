<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function show() {
        $users = DB::select("select * from users");
        //$mangroupe1 = DB::table('users')->where([['type', '=', 'manager'],['groupe', '=', '1'],])->get();


        return view('adminPage')->withUsers($users);
    }

    public function registerWithRole() {
        return view('registerWithRole');
    }

}
