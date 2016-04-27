<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Auth;
use CP\AjaxResponse;
use CP\API;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsersController extends Controller
{

    protected $api;
    protected $ajaxResponse;

    public function __construct() {
        $this->api = new API();
        $this->ajaxResponse = new AjaxResponse();
    }

    public function get(Request $request, $id) {

        return $this->api->getUserFromToken(true);
    }

    public function putUpdate(Request $request, $id) {

        $user = $this->api->getUserFromToken();

        $user->first = $request->get('first');
        $user->last = $request->get('last');
        $user->email = $request->get('email');

        try {
            $user->save();
        }
        catch (\Exception $e) {

            $message = ($e->getCode() == '23505') ? 'Email already exists in our system. Please use a different email address.' : $e->getMessage();

            return $this->ajaxResponse->error($message, 409, $e->getCode());
        }

        return $this->ajaxResponse->success('Your profile has been saved.', ['user' => $user]);
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

            // log user in and get token
            try {
                $token = JWTAuth::fromUser($user);
            }
            catch (\Exception $e) {

                return $this->ajaxResponse->error('Unable to generate token', 400, $e->getCode());
            }

            return $this->ajaxResponse->successWithToken($user->first . ' has been created!', $token);
        }
        catch (Exception $e) {

            // output human readable error message
            $message = ($e->getCode() == '23505') ? 'Email address is already in use.' : $e->getMessage();

            return $this->ajaxResponse->error($message);
        }
    }

    public function authenticate(Request $request) {

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (! $credentials['email'] || ! $credentials['password']) {

            return $this->ajaxResponse->error('Credentials missing', 401);
        }

        return $this->api->jwtLogin($credentials);
    }

}
