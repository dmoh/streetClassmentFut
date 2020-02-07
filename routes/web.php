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
    Route::prefix('users-management')->group(function (){
       Route::get('/', 'UserController@index')->name('index.users');
       Route::get('/add-user', 'UserController@create')->name('create.user');
       Route::post('/store-user', 'UserController@store')->name('store.user');
       Route::post('/update-user', 'UserController@update')->name('update.user');
       Route::post('/update-stats', 'UserController@updateStats')->name('update.stats');
       Route::get('/edit-player/{id}', 'UserController@edit')->where('id', '[0-9]+')->name('edit-player');
    });
    Route::middleware('ajax')->group(function (){
       Route::post('save-resume-match', 'MatchController@resumeMatch')->name('resume.match');
    });
   Route::prefix('matchs-management')->group(function(){
      Route::get('/', 'MatchController@matchsList')->name('matchslist');
      Route::post('/store', 'MatchController@store')->name('store.match');
      Route::get('/create', 'MatchController@create')->name('create.match');
      Route::get('/show/{id}', 'MatchController@show')->where('id', '[0-9]+')->name('show.match');
      Route::post('/close-vote', 'VoteController@closeVote')->name('close.match.vote');
   });


   Route::prefix('group')->group(function(){
      Route::get('/', 'GroupsController@index')->name('groups.list');
   });
});


Route::middleware('ajax')->group(function () {
    Route::post('images-save', 'UploadImagesController@store')->name('save-images');
    Route::delete('images-delete', 'UploadImagesController@destroy')->name('destroy-images');
    Route::get('images-server','UploadImagesController@getServerImages')->name('server-images');
    Route::post('show-player-hat', 'FrontEnd\FrontEndController@showPlayerByHat')->name('show-hat-player');
});






// Route::get('/front/index', 'FrontEnd\FrontEndController@index')->middleware(['auth', 'auth.access'])->name('front_index');
