<?php

namespace CP;

use Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class API {

    protected $ajaxResponse;

    public function __construct() {

        $this->ajaxResponse = new AjaxResponse();
    }

    /**
     * @param Request $request
     */
    public function auth(Request $request) {

        // check segments for controllers that share web & api auth
        $segments = $request->segment(1) . $request->segment(2);

        if ($segments == 'apiv1') {

            // check if email/password was provided
            if ($request->get('email') && $request->get('password')) {

                $user = JWTAuth::parseToken()->authenticate();

                return response()->json(compact('user'));
            }

            // check if token is set
            if ($request->has('token')) {

                // log user in and get token
                try {
                    $token = JWTAuth::getToken();
                    $user = JWTAuth::toUser($token);

                    return $this->ajaxResponse->error('fail');
                }
                catch (\Exception $e) {

                    return $this->ajaxResponse->error('Unable to generate token', 400, $e->getCode());
                }
            }
        }
        else {
            // return null so program can continue
            return null;
        }
    }

    public function getUserFromToken(bool $ajax=false) {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {

                return response()->json(['user_not_found'], 404);
            }
        }
        catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        }
        catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        }
        catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        $data = [
            'user' => $user
        ];

        // the token is valid and we have found the user via the sub claim
        return ($ajax) ? $this->ajaxResponse->success('User found', $data) : $user;
    }

    public function jwtLogin(array $credentials) {

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {

                $json = [
                    'success' => false,
                    'error' => [
                        'code' => 401,
                        'message' => 'Unauthorized.',
                    ],
                ];

                return response()->json($json, 401);
            }
        } catch (JWTException $e) {

            $json = [
                'success' => false,
                'error' => [
                    'code' => 500,
                    'message' => 'could_not_create_token'
                ],
            ];

            return response()->json($json, 500);
        }

        return response()->json(compact('token'));
    }

    public function verifyToken(Request $request) {

        if ($request->ajax()) {

            $token = JWTAuth::getToken();

            $user = JWTAuth::toUser($token);
        }
        else {
            $user = Auth::user();
        }

        return $user;
    }

}