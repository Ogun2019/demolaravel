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
Route::get('article/{n}', 'ArticleController@show')->where('n', '[0-9]+');

Route::get('facture/{n}', function($n) {
    return view('facture')->withNumero($n);
})->where('n', '[0-9]+');

Route::get('/', ['uses' => 'WelcomeController@index', 'as' => 'home']);
Route::get('users', 'UsersController@getInfos');
Route::post('users', 'UsersController@postInfos');
Route::get('contact', 'ContactController@getForm');
Route::post('contact', 'contactController@postForm');
Route::get('login', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@show')->middleware('is_admin')->name('admin');
Route::get('/manager', 'UsersController@manager')->middleware('is_manager')->name('manager');
Route::post('/manager', 'AchatDetailsController@create');
Route::get('/ajout_fournisseur', 'FournisseurController@show');
Route::post('/ajout_fournisseur', 'FournisseurController@register');
Route::get('/inscriptionRole', 'AdminController@registerWithRole')->middleware('is_admin')->name('admin');
Route::resource('users', 'UsersController');
Route::post('/user/suppression', 'UsersController@UserDelete');
Route::post('/user/update', 'UsersController@Update');
Route::post('/achat/updateAchat', 'AchatDetailsController@update');
Route::post('/achat/suppression', 'AchatDetailsController@destroy');
