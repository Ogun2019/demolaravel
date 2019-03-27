<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class intituleActionController extends Controller {

    public function register(Request $request) {
        $action_nom = $request->input('action_nom');
        
        DB::insert('insert into action (nom_action) values (?)', [strtoupper($action_nom )]);
        
        return redirect()->action('AdminController@show');
        
    }

    public function show() {

        return view('ajoutActionIntitule');
    }

}
