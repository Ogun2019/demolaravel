<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UsersController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function manager() {
        $users = DB::select("select * from users");
        $assistant = DB::table('users')->where([['type', '=', 'assistant'],])->get();
        $nbruser = DB::select("select count(*) as id from users");
        $manager = DB::table('users')->where([['type', '=', 'manager'],])->get();
        $fourni = DB::select("select * from fournisseur");

        //dd($mangroupe1,$assgroupe1,$nbruser,$users);
        return view('manager')->withNbruser($nbruser)->withUsers($users)->withAssistant($assistant)->withManager($manager)->withFourni($fourni);
    }

    public function UserDelete(Request $request) {
        DB::table('users')->where('id', '=', $request->input('btn-supp-user'))->delete();
        return redirect()->action(
                        'AdminController@show'
        );
    }

    public function update(Request $request) {
        
        DB::table('users')->where('id', $request->input('modifUser'))->update(['type' => $request->input('type'), 'groupe' => $request->input('groupe')]);
        return redirect()->action('AdminController@show');
    }

}
