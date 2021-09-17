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

Route::get('/', function () {
    return view('accueil');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('utilisateur', 'UtilisateurController');

Route::resource('annonce', 'AnnonceController');

Route::resource('signaler', 'SignalerController');

Route::resource('categories', 'CategoryController');

Route::resource('objectif', 'ObjetController');

Route::resource('questions', 'QuestionController');

Route::resource('reponses', 'ReponseController');

Route::resource('regions', 'RegionController');

Route::post('update-user','UtilisateurController@update');

Route::get('search', 'AnnonceController@search');

Route::get('mes-annonce', 'AnnonceController@mesAnnonce');

Route::resource('annonce', 'AnnonceController');

/* login user route*/
Route::get('/log-in','UtilisateurController@loginview')
->name('login1');

Route::get('/logout', 'UtilisateurController@logout');


Route::get('/edituser', 'UtilisateurController@showedit');


Route::post('authuser','UtilisateurController@loginuser');

Route::get('/admin', 'AdminController@admin')    
    ->middleware('is_admin')    
    ->name('admin');

Route::get('/list-user', 'AdminController@listuser')    
    ->middleware('is_admin')    
    ->name('listuser');
/* category */
Route::get('/category', 'AdminController@category')    
    ->middleware('is_admin')    
    ->name('category');
Route::get('/notification', 'AdminController@signaler')
//    ->middleware('is_admin')
    ->name('notification');

Route::post('ajCat','CategoryController@add');

Route::get('/ville', 'AdminController@ville')    
    ->middleware('is_admin')    
    ->name('ville');

Route::post('dlcat','CategoryController@destroy'); 


Route::post('ajVille','VilleController@add');

/*objet*/
Route::get('/objet', 'AdminController@objet')    
    ->middleware('is_admin')    
    ->name('objet');

Route::post('ajobject','ObjetController@add'); 

/*sous ville */
Route::get('/region', 'AdminController@region')    
    ->middleware('is_admin')    
    ->name('region');

Route::post('ajregion','RegionController@add'); 


Route::post('addsignal','SignalerController@add'); 



/* lost*/
Route::get('/lost', 'UtilisateurController@lost')   
    ->name('lost');
/* found*/
Route::get('/found', 'UtilisateurController@found')
    ->name('found');

    /*question */
Route::get('/question', 'AdminController@question')    
->middleware('is_admin')    
->name('question');

Route::post('ajquest','QuestionController@add'); 

    /*reponse */
Route::get('/reponse', 'AdminController@reponse')    
    ->middleware('is_admin')    
    ->name('reponse');

Route::post('ajrep','ReponseController@add'); 

Route::get('get-rep','ReponseController@getreponse');

/* lost */
Route::post('ajlost','AnnonceController@addLost');
/* found */
Route::post('ajfound','AnnonceController@add');

Route::post('searchobj','AnnonceController@searchobj'); 

Route::post('searchplace','AnnonceController@searchplace'); 

Route::post('save_answer','AnnonceController@saveanswer'); 

Route::get('/details/{id}', 'AnnonceController@detail')
    ->name('found');

Route::get(' signal-liste','AdminController@signalList');
    
   