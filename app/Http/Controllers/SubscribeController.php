<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SubscribeController extends Controller
{

    public function registerOrLogin(Request $request, $code=null) {

        if (isset($code)) {
            $request->session()->flash('code', $code);
        }

        return view('registerOrLogin', compact('code'));
    }

}
