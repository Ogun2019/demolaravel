<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use App\User;

Route::get('/', function () {

    return view('welcome');
});

Route::get('view1', function() {
    return view('firstview');
});

Route::get('template', function () {
    return view('infos');
});

Route::get('facture/{n}', function($n) {
    return view('facture')->withNumero($n);
})->where('n', '[0-9]+');

Route::get('/', ['uses' => 'WelcomeController@index', 'as' => 'home']);
Route::get('users', 'UsersController@getInfos');
Route::post('users', 'UsersController@postInfos');
Route::get('login', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@testAjax');

Route::get('/admin', 'AdminController@show')->middleware('is_admin')->name('admin');
Route::get('/manager', 'UsersController@manager')->middleware('is_manager')->name('manager');
Route::post('/manager', 'AchatDetailsController@create');
Route::get('/ajout_fournisseur', 'FournisseurController@show');
Route::post('/ajout_fournisseur', 'FournisseurController@register');
Route::get('/ajout_actionIntitule', 'intituleActionController@show');
Route::post('/ajout_actionIntitule', 'intituleActionController@register');
Route::get('/inscriptionRole', 'AdminController@registerWithRole')->middleware('is_admin')->name('admin');
Route::resource('users', 'UsersController');
Route::post('/user/suppression', 'UsersController@UserDelete');
Route::post('/user/update', 'UsersController@Update');
Route::post('/achat/updateAchat', 'AchatDetailsController@update');
Route::post('/achat/suppression', 'AchatDetailsController@destroy');

Route::get('/service_client', 'ServiceClientController@show')->middleware('is_sclient');
Route::get('/service_communication', 'ServiceCommController@show')->middleware('is_scomm');
/*Route::get('pweb', function () {
    return view('pweb');
})->middleware('is_pweb');*/
Route::post('/service_client', 'ServiceClientController@create');
Route::post('/service_communication', 'ServiceCommController@create');
//Route::post('/pweb', 'PwebController@create');
Route::get('/timeline', 'HomeController@loadTimeline');
Route::post('/editTimeline', 'AchatDetailsController@editTimeline');
Route::post('/editTab', 'AchatDetailsController@updateData')->name('update_data');
Route::get('/logs', function() {
    return view('logging');
});
Route::get('/logs', 'LogsController@index')->middleware('is_admin')->name('admin');
Route::get('/discussion/{id}', 'AchatDetailsController@showComment');
/*Route::get('/discussion/{id}', function ($id) {
    $act = DB::select('select id_achat_details,details_action,intitule_action from achat_details_des_offres where id_achat_details ='.$id);
    return view('/discussion')->withAction($act);
});*/
Route::post('/sendComment', 'AchatDetailsController@discussion');
Route::post('/saveDatatableState', 'DatatableController@saveState');
Route::post('/loadDatatableState', 'DatatableController@loadState');
Route::get('/autocomplete', 'AutocompleteController@index');
Route::get('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');
Route::get('/autocomplete/autoDetail_plv_fournisseur', 'AutocompleteController@autoDetail_plv_fournisseur');
Route::get('/autocomplete/autointervention', 'AutocompleteController@autoIntervention');
Route::get('/autocomplete/autoCommentaire', 'AutocompleteController@autoCommentaire');
Route::get('/user/profile', function() {
    $id = \Auth::user()->id;
    $userinfo = DB::table('users')->where('id', $id)->get();
    return view('profile',compact('userinfo'));
});
Route::post('/user/saveProfile', 'UsersController@saveUserProfile');
Route::post('/user/saveNotifParam', 'UsersController@saveUserParam');
Route::post('/user/saveNotifTimeParam', 'UsersController@saveNotifTimeParam');