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
use App\UsState;
use Tymon\JWTAuth\Facades\JWTAuth;

Route::get('/marketing-landing', function() {
    return view('marketing.home');
});

Route::get('/help', function() {
    return view('marketing.help');
});

Route::get('/forget-success', function() {
    \Request::session()->forget('success');

    return redirect()->back();
});

Route::get('/invite/{code?}', 'SubscribeController@registerOrLogin');

Route::get('/', function () {
    return view('marketing.home');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index');

    Route::get('/visitees', 'VisiteesController@index');
    Route::get('/visitees/create', 'VisiteesController@getCreate');
    Route::post('/visitees/create', 'VisiteesController@postCreate');
    Route::get('/visitees/check-in/{id}', 'VisiteesController@checkIn');
    Route::get('/visitees/{id}/edit', 'VisiteesController@getEdit');
    Route::post('/visitees/{id}/edit', 'VisiteesController@postEdit');
    Route::get('/visitees/{id}/remove', 'VisiteesController@remove');
    Route::get('/visitees/{id}/visits', 'VisitsController@index');
    Route::get('/visitees/{id}/visits/create', 'VisitsController@getCreate');
    Route::post('/visitees/{id}/visits/create', 'VisitsController@postCreate');
    Route::get('/visitees/{id}/notes', 'VisiteeNotesController@index');

    Route::get('/groups', 'GroupsController@index');
    Route::get('/groups/create', 'GroupsController@getCreate');
    Route::post('groups/create', 'GroupsController@postCreate');
    Route::get('groups/set-default/{id}', 'GroupsController@setDefaultGroup');

    // todo: fix URL ( groups/{id?}/join )
    Route::get('/groups/join/{id?}', 'GroupsController@joinGroup');

    Route::get('/groups/{id}/remove', 'GroupsController@removeFromGroup');
    Route::get('/groups/{id}/share', 'GroupsController@share');
    Route::post('/groups/{id}/share', 'GroupsController@sendShareEmails');

    Route::get('/requests/{code}/approve', 'GroupsController@approveJoinRequest');
});

Route::group(['prefix' => 'api/v1', 'middleware' => ['cors']], function() {

    Route::post('/authenticate', 'UsersController@authenticate');
    Route::post('/register', 'UsersController@create');

    Route::post('/image-upload', function() {

        // todo: move elsewhere... anywhere but here

        $destinationPath = 'uploads/';
        $saveAsName = str_random(40) . '.jpg';

        $file = \Request::file('file');

        if ($file->isValid()) {

            if ($fileObj = $file->move($destinationPath, $saveAsName)) {

                return $destinationPath . $saveAsName;
            }
            else {

                $json = ['success' => false, 'message' => 'Could not move file.'];

                return response()->json($json, 400);
            }
        }
        else {

            $json = ['success' => false, 'message' => 'File not valid.'];

            return response()->json($json, 400);
        }

    });
});

Route::group(['prefix' => 'api/v1', 'middleware' => ['cors', 'jwt.auth']], function() {

    Route::get('/groups', 'GroupsController@index');
    Route::post('/groups', 'GroupsController@postCreate');
    Route::get('/groups/{id}', 'GroupsController@getGroup');
    Route::post('/groups/{id}/update', 'GroupsController@update');
    Route::get('/groups/{id}/delete', 'GroupsController@delete');
    Route::post('/groups/join/{id?}', 'GroupsController@joinGroup');
    Route::post('/groups/{id}/share', 'GroupsController@sendShareEmails');
    Route::get('/visitees', ['uses' => 'VisiteesController@index']);
    Route::post('/visitees', ['uses' => 'VisiteesController@postVisitee']);
    Route::get('/visitees/{id}', 'VisiteesController@getVisitee');
    Route::post('/visitees/{id}', 'VisiteesController@putVisitee');
    Route::post('/visitees/check-in/{id}', 'VisiteesController@checkIn');
    Route::delete('/visitees/{id}', 'VisiteesController@deleteVisitee');

    Route::get('/users/{id}', 'UsersController@get');
    Route::put('/users/{id}', 'UsersController@putUpdate');
    Route::get('/destroy-token', 'UsersController@destroyToken');

});

Route::auth();

Route::get('functions/us-state', function() {

    return UsState::get(['id', 'name', 'abbr']);

});

if (App::environment() == 'local') {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}