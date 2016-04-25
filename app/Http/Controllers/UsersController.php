<?php

namespace App\Http\Controllers;

use Auth;
use CP\API;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{

    public function get(Request $request, $id) {

        $api = new API();
        $api->auth($request);

        $user = Auth::user();

        $data = [
            'first' => $user->first,
            'last' => $user->last,
            'email' => $user->email,
        ];

        return ['success' => true, 'user' => $data];
    }

    public function putUpdate(Request $request, $id) {

        $api = new API();
        $api->auth($request);

        $user = Auth::user();

        // todo: error handling if $user not found
        // todo: duplicate email exists error message

        $user->first = $request->get('first');
        $user->last = $request->get('last');
        $user->email = $request->get('email');
        $user->save();

        return ['success' => true, 'message' => 'Your profile has been saved.'];
    }

}
