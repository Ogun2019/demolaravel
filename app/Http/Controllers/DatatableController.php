<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DatatableController extends Controller {

    public function saveState(Request $request) {
        try { 
            DB::statement("INSERT INTO `datatable_state`(`name`, `state`,`user_id`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE state= VALUES (state)", [$request->name,$request->state,$request->userid]);
            echo $request->state;
        } catch (PDOException $e) {
            print "ERROR !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function loadState(Request $request) {
        try {
            $data = DB::table('datatable_state')->select('state')->where('name', 'like', $request->name)->get();
            
            echo $data[0]->state;
        } catch (PDOException $e) {
            print "ERROR !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}
