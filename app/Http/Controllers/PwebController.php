<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

class PwebController extends Controller {

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
                    'slidePrincipale' => 'required',
                    'blockhp' => 'required',
                    'layer' => 'required',
                    'banncat' => 'required',
                    'id_label' => 'required',
                    'refdecolisees' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
            //return response()->view("errorPage");
        }

        DB::table('web')->insert([
            [
                'slidep' => $request->input('slidePrincipale'),
                'blockhp' => $request->input('blockhp'),
                'layer' => $request->input('layer'),
                'bancat' => $request->input('banncat'),
                'label' => $request->input('id_label'),
                'refdec' => $request->input('refdecolisees'),
            ]
        ]);

        $web = DB::select("select * from web");

        return redirect()->action('HomeController@index')->withWeb($web);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
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
