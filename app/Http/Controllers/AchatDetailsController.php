<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
Use App\Notifications\test;

class AchatDetailsController extends Controller {

    public function create(Request $request) {
        $date = date('Y-m-d');
        
        DB::table('achat_details_des_offres')->insert([
            [
                'date' => $date,
                'category_manager' => $request->input('grp'),
                'assistant' => $request->input('assistantName'),
                'fournisseur' => $request->input('fournisseur'),
                'intitule_action' => $request->input('intituleAction'),
                'numero_semaine' => $request->input('numeroSemaine'),
                'date_debut' => $request->input('dated'),
                'date_fin' => $request->input('datef'),
                'epuisement' => $request->input('epuisement'),
                'valable_fr' => $request->input('valableFr'),
                'valable_be' => $request->input('valableBe'),
                'valable_lux' => $request->input('valableLux'),
                'valable_sui' => $request->input('valableSui'),
                'valable_It' => $request->input('valableIt'),
                'presence_cat' => $request->input('presenceCat'),
                'num_page_cat' => $request->input('numPageCat'),
                'details_action' => $request->input('detailAction'),
                'offre' => $request->input('offreCadeau'),
                'remise' => $request->input('remise'),
                'intervention' => $request->input('interventionMax'),
                'plv_fournisseur' => $request->input('plvFournisseur'),
                'commentaire' => $request->input('commentaire'),
            ]
        ]);
        (new User)->forceFill(['name' => 'Maxi Toys','email' => 'demonstration@demonstration.be',])->notify(new test);
        return redirect()->action('HomeController@index');
    }

    public function update(Request $request) {

        DB::table('achat_details_des_offres')->where('id_achat_details', $request->input('modifAchatid'))->update(['date_fin' => $request->input('datef')]);

        return redirect()->action('HomeController@index');
    }

    public function destroy(Request $request) {

        DB::table('achat_details_des_offres')->where('id_achat_details', '=', $request->input('btn-supp-achat'))->delete();

        return redirect()->action('HomeController@index');
    }

}
