<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Notifications\ajoutAction;
use App\Notifications\modificationAction;
use App\Notifications\suppressionAction;
use App\Notifications\nouveauCommentaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Log;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Process\Process;

class AchatDetailsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function create(Request $request) {
        switch ($request->input('presenceCat')) {
            case "C01": $couleur = "#FF0000";
                break; //rouge
            case "C02": $couleur = "#FFD700";
                break; //jaune
            case "C03": $couleur = "#00FF00";
                break; //vert
            case "C04": $couleur = "#FF007F";
                break; //rose
            case "C05": $couleur = "#7F00FF";
                break; //mauve
            case "C06": $couleur = "#007FFF";
                break; //bleu clair
            case "C07": $couleur = "#00FFFF";
                break; //turquoise
            case "C08": $couleur = "#75512D";
                break; //brun
            case "C09": $couleur = "#BABAAA";
                break; //gris
            case "C10": $couleur = "#155535";
                break; //vert foncé
            case "C11": $couleur = "#780C0C";
                break; //bordeaux
            case "C12": $couleur = "#106E6E";
                break; //#106E6E
        }
        //$validator->validate(); 
        $date = date('Y-m-d');

        if ($request->hasFile('flyerFile')) {
            $path = $request->file('flyerFile')->store('uploads');
        }
        if ($request->hasFile('plvFile')) {
            $request->file('plvFile')->store('uploads');
        }
        if ($request->input('validiteAction2') == null && $request->input('validiteAction3') == null) {
            $dropshipment = $request->input('validiteAction1');
        } else {
            $dropshipment = $request->input('validiteAction1') . "|" . $request->input('validiteAction2') . "|" . $request->input('validiteAction3');
        }


        //Storage::putFile('public',$request->file('flyerFile')); //upload file
        //$nextId = DB::table('achat_details_des_offres')->max('id_achat_details') + 1;
        $statement = DB::select("SHOW TABLE STATUS LIKE 'achat_details_des_offres'");
        $nextId = $statement[0]->Auto_increment;

        $validator2 = Validator::make($request->all(), [
                    'grp' => 'required'
        ]);
        if ($validator2->fails()) {
            return response()->json(['error' => 'Champs manager est obligatoire'], 401);
            //return response()->view("errorPage");
        }

        $validator = Validator::make($request->all(), [
                    'datef' => 'required|after:dated',
                    'fournisseur' => 'required',
                    'intituleAction' => 'required',
                    'numeroSemaine' => 'required',
                    'dated' => 'required|date',
                    'datef' => 'required|date',
                    'epuisement' => 'required',
                    'valableFr' => 'required',
                    'valableBe' => 'required',
                    'valableLux' => 'required',
                    'valableSui' => 'required',
                    'valableIt' => 'required',
                    'presenceCat' => 'required',
                    'numPageCat' => 'required',
                    'detailAction' => 'required',
                    'offreCadeau' => 'required',
                    'remise' => 'required',
                    'interventionMax' => 'required',
                    'plvFournisseur' => 'required',
                    'detailplvFournisseur' => 'required',
                    'quantite_plv' => 'required',
                    'date_liv_logitoys' => 'required',
                    'contact_plv' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
            //return response()->view("errorPage");
        }
        DB::table('achat_details_des_offres')->insert([
            [
                //'date' => $date,
                //'category_manager' => $request->input('grp'),
                //'assistant' => $request->input('assistantName'),
                'num' => $request->input('numaction'),
                'fournisseur_id_fk' => $request->input('fournisseur'),
                'intitule_action' => $request->input('intituleAction'),
                'action_fk' => $request->input('intituleAction'),
                'numero_semaine' => $request->input('numeroSemaine'),
                'date_debut' => $request->input('dated'),
                'date_fin' => $request->input('datef'),
                'epuisement' => $request->input('epuisement'),
                'valable_fr' => $request->input('valableFr'),
                'valable_be' => $request->input('valableBe'),
                'valable_lux' => $request->input('valableLux'),
                'valable_ch' => $request->input('valableSui'),
                'valable_It' => $request->input('valableIt'),
                'presence_cat' => $request->input('presenceCat'),
                'num_page_cat' => $request->input('numPageCat'),
                'details_action' => $request->input('detailAction'),
                'offre' => $request->input('offreCadeau'),
                'remise' => $request->input('remise'),
                'intervention' => $request->input('interventionMax'),
                'plv_fournisseur' => $request->input('plvFournisseur'),
                'commentaire' => $request->input('commentaire'),
                'detail_plv_fournisseur' => $request->input('detailplvFournisseur'),
                'f1' => $request->input('f1'),
                'f2' => $request->input('f2'),
                'f3' => $request->input('f3'),
                'f4' => $request->input('f4'),
                'quantite_plv' => $request->input('quantite_plv'),
                'date_livraison_logitoys' => $request->input('date_liv_logitoys'),
                'commentaire_plv' => $request->input('comm_plv'),
                'contact_plv' => $request->input('contact_plv'),
                'validite_action1' => $dropshipment, //line 56
                'color' => $couleur,
            ]
        ]);


        DB::table('details_des_offres')->insert([
            [
                'date_creation' => $date,
                'id_user_fk' => $request->input('grp'),
                'id_achat_details_fk' => $nextId,
                'assistant_d' => $request->input('assistantName'),
            //'id_achat_details_fk' => $request->input('uniqueid'),
            ]
        ]);

        $record['log'] = [
            'user_id' => auth()->user() ? auth()->user()->id : NULL,
            'user_name' => auth()->user()->name,
            'user_email' => auth()->user()->email,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'action_id' => $nextId,
        ];
        $ldate = date('Y-m-d H:i:s');
        DB::table('logs')->insert([
            [
                'date_a' => $ldate,
                'id_u' => auth()->user()->id,
                'email_u' => auth()->user()->email,
                'name_u' => auth()->user()->name,
                'type' => "ajout d'une action",
                'action_id' => $nextId,
                'intitule_a' => $request->input('intituleAction'),
            ]
        ]);


        /*
         * autocomplete new suggestion
         */

        DB::table('autocomplete_info')->insert([
            ['valeur' => $request->input('detailplvFournisseur')]
        ]);

        $users = User::all();
        foreach ($users as $use) {
            if ($use->notification == 'checked') {
                if ($use->notification_time == 'true') {
                    Notification::send($use, new ajoutAction($nextId,"0"));
                }else{
                    Notification::send($use, new ajoutAction($nextId,"1"));
                }
            }
        }


        /* $user = Auth::user();
          $Log=Log::channel('ajoutachat');
          $Log->pushHandler(new StreamHandler(storage_path('logs/ajoutachat.log')), Logger::INFO);
          //$Log->info("/**** action ajouté par :",compact('user'));
          //$Log->info(["Information de l\action *** *///: " => $request]);
        //$Log->info($record['log']);
        //(new User)->forceFill(['name' => 'Maxi Toys', 'email' => 'demonstration@demonstration.be',])->notify(new test);
        return redirect()->action('HomeController@index');
    }

    public function updateData(Request $request) {
        if ($request->ajax()) {
            $data = array(
                $request->column_name => $request->column_value
            );
            if (!is_null($request->column_value)) {

                if ($request->column_name === "date_fin") {


                    $validator = Validator::make($request->all(), [
                                'column_value' => 'required|after:dated',
                    ]);
                    //$validator->validate();
                    if ($validator->fails()) {
                        return response()->json(['error' => $validator->errors()], abort(403, 'Cette modification ne sera pas enregistrée.Ce champs date est obligatoire et doit être supérieur à la date de début.'));
                        //return response()->view("errorPage");
                    }
                } elseif ($request->column_name === "date_debut") {
                    $validator = Validator::make($request->all(), [
                                'column_value' => 'required|before:datef',
                    ]);
                    //$validator->validate();
                    if ($validator->fails()) {
                        return response()->json(['error' => $validator->errors()], abort(403, 'Cette modification ne sera pas enregistrée.Ce champs date est obligatoire et doit être inférieur à la date de fin.'));
                        //return response()->view("errorPage");
                    }
                }

                $act = DB::select("select intitule_action from achat_details_des_offres where id_achat_details = " . $request->id);
                DB::table('achat_details_des_offres')->where('id_achat_details', $request->id)->update($data);
                echo '<div class="alert alert-success">Data Updated</div>';
                $ldate = date('Y-m-d H:i:s');
                DB::table('logs')->insert([
                    [
                        'date_a' => $ldate,
                        'id_u' => auth()->user()->id,
                        'email_u' => auth()->user()->email,
                        'name_u' => auth()->user()->name,
                        'type' => "modification d'une action",
                        'action_id' => $request->id,
                        'intitule_a' => $act[0]->intitule_action,
                        'colonne_m' => $request->column_name,
                        'colonne_v' => $request->column_value,
                    ]
                ]);
                $users = User::all();
                foreach ($users as $use) {
                    if ($use->notification == 'checked') {
                        if ($use->notification_time == 'true') {
                            Notification::send($use, new modificationAction($use,$request->id,"0"));
                        }else{
                            Notification::send($use, new modificationAction($use,$request->id,"1"));
                        }
                    }
                }
                /*$process = new PhpProcess('php ' . base_path('artisan queu:work'));
                $process->start();*/
            } else {
                echo 'vide';
            }
        }
    }

    /* public function update(Request $request) {

      $validator = Validator::make($request->all(), [
      'datef' => 'required|after:dated',
      ]);
      //$validator->validate();
      if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], abort(403, 'Ce champs date est obligatoire et doit être supérieur à la date de début '));
      //return response()->view("errorPage");
      }

      $user = Auth::user();
      //$userAll = User::all();

      DB::table('achat_details_des_offres')->where('id_achat_details', $request->input('modifAchatid'))->update(['date_fin' => $request->input('datef')]);
      (new User)->forceFill(['name' => 'Maxi Toys', 'email' => 'demonstration@demonstration.be',])->notify(new updateAction($user, $request->input('modifAchatid')));
      /* foreach ($userAll as $user) {
      $user->notify(new updateAction($user, $request->input('modifAchatid')));

      } */
    /*  return redirect()->action('HomeController@index');
      } */

    public function destroy(Request $request) {
        $act = DB::select("select * from achat_details_des_offres where id_achat_details = " . $request->input('btn-supp-achat'));
        $action['all'] = $act;
        $ldate = date('Y-m-d H:i:s');
        $record['log'] = [
            'user_id' => auth()->user() ? auth()->user()->id : NULL,
            'user_name' => auth()->user()->name,
            'user_email' => auth()->user()->email,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'action_id' => $request->input('btn-supp-achat'),
            'intitule_a' => $act[0]->intitule_action,
        ];

        $user = Auth::user();
        $Log = Log::channel('destroyachat');
        $Log->pushHandler(new StreamHandler(storage_path('logs/destroyAchat.log')), Logger::INFO);
        $Log->info("/**** action ajouté par :", compact('user'));
        $Log->info(["Information de l\'action *** *///: " => $request]);
        $Log->info($record['log']);
        $Log->info($action['all']);

        DB::table('logs')->insert([
            [
                'date_a' => $ldate,
                'id_u' => auth()->user()->id,
                'email_u' => auth()->user()->email,
                'name_u' => auth()->user()->name,
                'type' => "suppression d'une action",
                'action_id' => $request->input('btn-supp-achat'),
                'intitule_a' => $act[0]->intitule_action,
            ]
        ]);
        $actionid=$request->input('btn-supp-achat');
        DB::table('achat_details_des_offres')->where('id_achat_details', '=', $request->input('btn-supp-achat'))->delete();
        DB::table('details_des_offres')->where('id_achat_details_fk', '=', $request->input('btn-supp-achat'))->delete();
        $users = User::all();
        foreach ($users as $use) {
            if ($use->notification == 'checked') {
                if ($use->notification_time == 'true') {
                     Notification::send($use, new suppressionAction($actionid,"0"));
                } else {
                     Notification::send($use, new suppressionAction($actionid,"1"));
                }
            }
        }
        /*$process = new PhpProcess('php ' . base_path('artisan queu:work --stop-when-empty'));
        $process->start();*/

        //(new User)->forceFill(['name' => 'Maxi Toys', 'email' => 'demonstration@demonstration.be',])->notify(new destroyAction($request->input('btn-supp-achat')));
        return redirect()->action('HomeController@index');
    }

    //yy/timeline
    public function editTimeline(Request $request) {
        if ($request->input('color') != "" && $request->input('id') != "") {

            DB::table('achat_details_des_offres')->where('id_achat_details', $request->input('id'))->update(['color' => $request->input('color')]);
        } else {
            return view('timeline');
        }
        return view('timeline');
    }

    public function discussion(Request $request) {
        $ldate = date('Y-m-d H:i:s');
        DB::table('discussion')->insert([
            [
                'id_expediteur' => $request->input("btn-comment-userid"),
                'id_action' => $request->input("idaction"),
                'commentaire' => $request->input("d_commentaire"),
                'date_message' => $ldate
            ]
        ]);
        $users = User::all();
        foreach ($users as $use) {
            if ($use->notification == 'checked') {
                Notification::send($use, new nouveauCommentaire($request->input("btn-comment-userid"), $request->input("idaction")));
            }
        }
        //$process = new PhpProcess(base_path('php artisan queu:work'));
        //$process = exec("php " . base_path("artisan queu:work --stop-when-empty > /dev/null &"));
        //$process = new Process('php ../artisan queu:work --stop-when-empty');
        //$process->start();
        //Artisan::call('queue:work', ['--stop-when-empty' => true]);
        return redirect()->action('AchatDetailsController@showComment', [$request->input("idaction")]);
    }

    public function showComment($id) {
        $act = DB::table('discussion')
                ->join('achat_details_des_offres', 'achat_details_des_offres.id_achat_details', '=', 'discussion.id_action')
                ->join('users', 'users.id', '=', 'discussion.id_expediteur')
                ->select('achat_details_des_offres.id_achat_details', 'achat_details_des_offres.intitule_action', 'achat_details_des_offres.details_action', 'users.*', 'discussion.*')
                ->where('achat_details_des_offres.id_achat_details', '=', $id)
                ->get();
        $action = DB::select('select id_achat_details,details_action,intitule_action from achat_details_des_offres where id_achat_details =' . $id);
        if (count($act) > 0) {

            return view('/discussion')->withAction($act)->withAct($action);
        } else {
            $act = DB::select('select id_achat_details,details_action,intitule_action from achat_details_des_offres where id_achat_details =' . $id);
            return view('/discussion')->withAct($act);
        }
    }

}
