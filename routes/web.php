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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin',function (){
    return "YOU ARE LOGGED BY ADMIN";
})->middleware(['auth', 'auth.access']);


Route::middleware ('auth')->group(function (){
   Route::resource('photo', 'PhotoController', [
       'only' => ['create', 'store', 'destroy', 'update']
   ]);
   Route::prefix('consultation')->group(function (){
      Route::get('/', 'FrontEnd\FrontEndController@index')->name('consultation.index');
      Route::get('profil/{id}', 'FrontEnd\FrontEndController@showProfile')->where('id', '[0-9]+')->name('consultation.showProfile');
   });
   Route::get('/vote', 'VoteController@index')->name('vote.index');
   Route::post('/my-vote', 'VoteController@saveVote')->name('vote.save');

   Route::get('/matchs', 'MatchController@index')->name('matchs.list');

});


Route::middleware(['auth', 'auth.access'])->group(function (){
   Route::prefix('matchs-management')->group(function(){
      Route::get('/', 'MatchController@matchsList')->name('matchslist');
      Route::post('/store', 'MatchController@store')->name('store.match');
      Route::get('/create', 'MatchController@create')->name('create.match');
   });


});






// Route::get('/front/index', 'FrontEnd\FrontEndController@index')->middleware(['auth', 'auth.access'])->name('front_index');
