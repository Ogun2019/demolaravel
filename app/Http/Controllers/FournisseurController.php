<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FournisseurController extends Controller {

    public function register(Request $request) {
        $nom_fourni = $request->input('fournisseur_nom');
        
        DB::insert('insert into fournisseur (fournisseur_nom) values (?)', [strtoupper($nom_fourni )]);
        
        return redirect()->action('AdminController@show');
        
    }

    public function show() {

        return view('ajoutFournisseur');
    }

}
