<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use CP\API;
use Exception;
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

    public function create(Request $request)
    {
        try {
            $user = User::create([
                'first' => $request->get('first'),
                'last' => $request->get('last'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);

            // log user in and remember
            Auth::login($user, true);

            // todo: return token if not already sent

            return [
                'success' => true,
                'message' => $user->first . ' has been created!'
            ];
        }
        catch (Exception $e) {

            // output human readable error message
            $message = ($e->getCode() == '23505') ? 'Email address is already in use.' : $e->getMessage();

            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $message,
                ],
            ];

            return response()->json($json, 400);
        }
    }

}
