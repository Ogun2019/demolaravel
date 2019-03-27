<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ServiceCommController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {        
        DB::table('achat_details_des_offres')->where('id_achat_details', $request->input('idact'))->update([
            'type_plv' => $request->input('typeplv'),
            'date_co_plvf' => $request->input('datecplvf'),
            'num_commandef' => $request->input('numcomf'),
            'date_liv_logt_plvf' => $request->input('datelivlogplvf'),
        ]);

        /*DB::table('service_communication')->insert([
            [
                'date_co_plvf' => $request->input('datecplvf'),
                'num_commandef' => $request->input('numcomf'),
                'date_liv_logt_plvf' => $request->input('datelivlogplvf'),
                'num_commande_mt' => $request->input('plvmaxitoysnumcom'),
                'dateco_plvmt' => $request->input('plvmaxitoysdatecom'),
                'date_liv_logt_plvmt' => $request->input('plvmaxitoysdateliv'),
            ]
        ]);

        $servcom = DB::select("select * from service_communication");
        */
        return redirect()->action('HomeController@index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    public function show() {
        $act = DB::select("select id_achat_details,details_action from achat_details_des_offres order by id_achat_details ");
    
        return view('service_communication')->withAct($act);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
