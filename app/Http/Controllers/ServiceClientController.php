<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class ServiceClientController extends Controller {

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
        $validator = Validator::make($request->all(), [
                    'actparam' => 'required',
                    'actFr' => 'required|integer',
                    'actBe' => 'required|integer',
                    'actLu' => 'required|integer',
                    'actCh' => 'required|integer',
                    'actIt' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
            //return response()->view("errorPage");
        }

        DB::table('achat_details_des_offres')->where('id_achat_details', $request->input('idact'))->update([
            'actionparam' => $request->input('actparam'),
            'actionFr' => $request->input('actFr'),
            'actionBe' => $request->input('actBe'),
            'actionLu' => $request->input('actLu'),
            'actionCh' => $request->input('actCh'),
            'actionIt' => $request->input('actIt'),
        ]);
        
        return redirect()->action('HomeController@index');
        /* DB::table('service_client')->insert([
          [
          'actionparam' => $request->input('actparam'),
          'actionFr' => $request->input('actFr'),
          'actionBe' => $request->input('actBe'),
          'actionLu' => $request->input('actLu'),
          'actionCh' => $request->input('actCh'),
          'actionIt' => $request->input('actIt'),
          ]
          ]);

          $actionparam = DB::select("select * from service_client");
          return redirect()->action('HomeController@index')->withActionparam($actionparam); */
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

        return view('service_client')->withAct($act);
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
