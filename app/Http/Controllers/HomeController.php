<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use \Response;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
         $achat_details = DB::table('achat_details_des_offres')
          ->join('details_des_offres', 'details_des_offres.id_achat_details_fk', '=', 'achat_details_des_offres.id_achat_details')
          ->join('users as us1', 'us1.id', '=', 'details_des_offres.id_user_fk')
          ->join('users as us2', 'us1.id', '=', 'us2.sup')
          ->join('fournisseur', 'fournisseur.id_fournisseur', '=', 'achat_details_des_offres.fournisseur_id_fk')
          ->join('action', 'action.id_action', '=', 'achat_details_des_offres.action_fk')
          ->select('achat_details_des_offres.*', 'us1.name as nameman','us2.name as nameass','details_des_offres.*','fournisseur.*','action.*')
          ->groupBy('id_achat_details')
          ->get(); 
         //$actionparam = DB::select("select * from service_client");
         //$servcom = DB::select("select num_commandef,num_commande_mt,DATE_FORMAT(date_co_plvf, '%d/%m/%Y') as date_co_plvf,DATE_FORMAT(date_liv_logt_plvf, '%d/%m/%Y') as date_liv_logt_plvf ,DATE_FORMAT(dateco_plvmt,'%d/%m/%Y') as dateco_plvmt,DATE_FORMAT(date_liv_logt_plvmt,'%d/%m/%Y') as date_liv_logt_plvmt from service_communication");
         $web = DB::select("select * from web");
         //dd($achat_details);
         
         
        /* $achat_details2 = DB::table('achat_details_des_offres')
          ->join('details_des_offres', 'details_des_offres.id_achat_details_fk', '=', 'achat_details_des_offres.id_achat_details')
          ->join('users as us1', 'us1.id', '=', 'details_des_offres.id_user_fk')
          ->join('users as us2', 'us1.id', '=', 'us2.sup')
          ->join('role', 'assistant_d', '=', 'role.inf')
          ->join('fournisseur', 'fournisseur.id_fournisseur', '=', 'achat_details_des_offres.fournisseur_id_fk')
          ->select('achat_details_des_offres.*', 'us1.name as nameman','us2.name as nameass','details_des_offres.*','fournisseur.*')
          ->groupBy('id_achat_details')
          ->get(); */
         

         
         /*$key = DB::table('users as us')
                ->join('users as us2', 'us.id', '=', 'us2.sup')
                ->pluck('us2.name');   
        dd($key);*/
        //$user = User::find($users[0]->id_assistant_fk);
        //dd($users);
        //$achat_details = DB::select("select * from achat_details_des_offres");
        //array_push($users,$user);
        //dd($users);        
        $aff = DB::table('datatable_state')->where('user_id',auth()->user()->id)->get();
        return view('home')->withAchat($achat_details)->withWeb($web)->withAfftable($aff);
    }
    
        public function testAjax() {
         $achat_details = DB::table('achat_details_des_offres')
          ->join('details_des_offres', 'details_des_offres.id_achat_details_fk', '=', 'achat_details_des_offres.id_achat_details')
          ->join('users as us1', 'us1.id', '=', 'details_des_offres.id_user_fk')
          ->join('users as us2', 'us1.id', '=', 'us2.sup')
          ->join('fournisseur', 'fournisseur.id_fournisseur', '=', 'achat_details_des_offres.fournisseur_id_fk')
          ->join('action', 'action.id_action', '=', 'achat_details_des_offres.action_fk')
          ->select('achat_details_des_offres.*', 'us1.name as nameman','us2.name as nameass','details_des_offres.*','fournisseur.*','action.*')
          ->groupBy('id_achat_details')
          ->get()->toArray(); 
          return Response::json(array(
                    'data'   => $achat_details
                )); 
    }
    
    public function loadTimeline(){
                 $achat_details = DB::table('achat_details_des_offres')
          ->join('details_des_offres', 'details_des_offres.id_achat_details_fk', '=', 'achat_details_des_offres.id_achat_details')
          ->join('users as us1', 'us1.id', '=', 'details_des_offres.id_user_fk')
          ->join('users as us2', 'us1.id', '=', 'us2.sup')
          ->join('fournisseur', 'fournisseur.id_fournisseur', '=', 'achat_details_des_offres.fournisseur_id_fk')
          ->join('action', 'action.id_action', '=', 'achat_details_des_offres.action_fk')
          ->select('achat_details_des_offres.*', 'us1.name as nameman','us2.name as nameass','details_des_offres.*','fournisseur.*','action.*')
          ->groupBy('id_achat_details')
          ->get(); 
        $actions = json_decode(json_encode($achat_details), True);
        return view("timeline")->withActions($actions);         
    }
    
}
