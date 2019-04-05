<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function manager() {
        $user_groupe = DB::table('users as us1')
                ->join('users as us2', 'us1.id', '=', 'us2.sup')
                ->select('us1.name as nameman', 'us1.id as idman', 'us1.email as emailman', 'us1.type as typeman', 'us1.sup as supman', 'us2.id as idass', 'us2.name as nameass', 'us2.email as emailass', 'us2.type as typeass', 'us2.sup as supass')
                ->orderBy('us1.id', 'ASC')
                ->get();

        $users = User::all();
        $assistant = DB::table('users')->where([['type', '=', 'assistant'],])->get();
        $nbruser = DB::select("select count(*) as id from users");
        $manager = DB::table('users')->where([['type', '=', 'manager'],])->get();
        $fourni = DB::select("select * from fournisseur");
        $actions = DB::select("select * from action");
        //dd($mangroupe1,$assgroupe1,$nbruser,$users);
        $nbrachat = DB::select("select max(num) as nbraction from achat_details_des_offres");
        return view('manager')->withNbruser($nbruser)->withUsers($users)->withAssistant($assistant)->withManager($manager)->withFourni($fourni)->withAchat($nbrachat)->withUsergroupe($user_groupe)->withActions($actions);
    }

    public function UserDelete(Request $request) {
        try {
            DB::table('users')->where('id', '=', $request->input('btn-supp-user'))->delete();
            return redirect()->action(
                            'AdminController@show'
            );
        } catch (\Exception $e) {

            return abort(403, 'Cet utilisateur est manager/assistant d\'une action. Supprimer d\'abord tous les actions paramétrées par celui-ci.');
        }


        DB::table('users')->where('id', '=', $request->input('btn-supp-user'))->delete();
        return redirect()->action(
                        'AdminController@show'
        );
    }

    public function update(Request $request) {
        DB::table('users')->where('id', $request->input('modifUser'))->update([
            'type' => $request->input('type'),
            'groupe' => $request->input('groupe'),
            'sup' => $request->input('idsup')
        ]);
        return redirect()->action('AdminController@show');
    }

    public function testlogs() {
        $audits = User::find(1)->audits;
        return view('logstest')->compact('audits');
    }

    public function saveUserProfile(Request $request) {
        $user = Auth::user();
        $extensions = ['jpg', 'jpeg', 'png'];
        $isImage = $request->file('profilePicture')->getClientOriginalExtension();

        if (in_array($isImage, $extensions)) {
            //DB::table('users')->update(['profileImage' => $request->file('profilePicture')->getClientOriginalName()])->where("id", auth()->user()->id);
            DB::table('users')->where('id', $user->id)->update([
                'profileImage' => $request->file('profilePicture')->getClientOriginalName()
            ]);

            $request->file('profilePicture')->storeAs('public', $request->file('profilePicture')->getClientOriginalName());
            //$request->file('profilePicture')->store('uploads');
        }
        return redirect('/user/profile');
    }
    
    public function saveUserParam(Request $request) {
        DB::table('users')->where('id', $request->userid)->update([
                'notification' => $request->valeur
            ]);
        return $request->valeur;
    }
    public function saveNotifTimeParam(Request $request) {
        try{
        DB::table('users')->where('id', $request->userid)->update([
                'notification_time' => $request->valeur
            ]);
        return "ok";
        } catch (Exception $ex){
            return $ex + "not work";
        }
    }

}
