<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// todo: remove
Route::get('/forget-success', function() {
    \Request::session()->forget('success');

    return redirect()->back();
});

Route::get('/', function () {
    return redirect('visitees');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index');

    Route::get('/visitees', 'VisiteesController@index');
    Route::get('/visitees/create', 'VisiteesController@getCreate');
    Route::post('/visitees/create', 'VisiteesController@postCreate');
    Route::get('/visitees/check-in/{id}', 'VisiteesController@checkIn');
    Route::get('/visitees/{id}/remove', 'VisiteesController@remove');
    Route::get('/visitees/{id}/visits', 'VisitsController@index');
    Route::get('/visitees/{id}/visits/create', 'VisitsController@getCreate');
    Route::post('/visitees/{id}/visits/create', 'VisitsController@postCreate');
    Route::get('/visitees/{id}/notes', 'VisiteeNotesController@index');

    Route::get('/groups', 'GroupsController@index');
    Route::get('/groups/create', 'GroupsController@getCreate');
    Route::post('groups/create', 'GroupsController@postCreate');
    Route::get('groups/set-default/{id}', 'GroupsController@setDefaultGroup');
    Route::get('/groups/join/{id?}', 'GroupsController@joinGroup');
});

Route::group(['prefix' => 'api/v1'], function() {
    Route::get('/groups', 'GroupsController@returnAllGroups');
});

Route::auth();