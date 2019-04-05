<?php

namespace App\Http\Controllers;

use DB;

class LogsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $logs = DB::select("select id_u,email_u,name_u,type,action_id,intitule_a,colonne_m,colonne_v,date_a from logs ");
        
        return view('logging')->withLogs($logs);
    }

}
