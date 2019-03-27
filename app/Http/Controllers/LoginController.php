<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use DB;

class loginController extends BaseController
{
     public function login(Request $req)
     {
      $username = $req->input('username');
      $password = $req->input('password');

      $checkLogin = DB::table('utilisateur')->where(['nom'=>$username,'mdp'=>$password])->get();
      if(count($checkLogin)  >0)
      {
       echo "Connexion réussi<br/>";;
      }
      else
      {
       echo "erreur";
      }
     }
}

?>