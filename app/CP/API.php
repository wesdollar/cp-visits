<?php

namespace CP;

use Auth;
use Illuminate\Http\Request;

class API {

    /**
     * @param Request $request
     */
    public function auth(Request $request) {

        $segments = $request->segment(1) . $request->segment(2);

        if ($segments == 'apiv1') {

            Auth::attempt(['email' => 'wdollar@callingpost.com', 'password' => 'supersecretpassword']);

            return true;
        }
        else {
            return null;
        }
    }

}