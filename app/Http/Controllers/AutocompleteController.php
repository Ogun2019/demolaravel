<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AutocompleteController extends Controller {

    public function fetch(Request $request) {

        try {
            $return_arr = array();

            //$stmt = DB::statement("SELECT valeur FROM autocomplete_info WHERE valeur LIKE ?", ['%' . $request->get('term') . '%']);
            //$data = DB::table('autocomplete_info')->select('valeur')->where('valeur', 'like', '%' . $request->get('term') . '%')->get();
           $data =  DB::table('achat_details_des_offres')->where('details_action', 'like', '%' . $request->get('term') . '%')->groupBy('details_action')->get();
            echo $data;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /* function fetch(Request $request)
      {
      if($request->get('query'))
      {
      $query = $request->get('query');
      $data = DB::table('autocomplete_info')
      ->where('valeur', 'LIKE', "%{$query}%")
      ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
      $output .= '
      <li>'.$row->valeur.'</li>
      ';
      }
      $output .= '</ul>';
      echo $output;
      }
      } */
}
