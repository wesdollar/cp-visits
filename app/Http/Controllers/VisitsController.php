<?php

namespace App\Http\Controllers;

use App\CheckinType;
use App\Visit;
use App\Visitee;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class VisitsController extends Controller
{
    public function index($visiteeId) {

        $visitee = Visitee::findOrFail($visiteeId);
        $header = 'Visitors Log';

        return view('visits.list', compact('visitee', 'header'));
    }

    /**
     * @param $visiteeId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate($visiteeId) {

        $visitee = Visitee::findOrFail($visiteeId);

        $categories = CheckinType::where('active', true)->get();

        return view('visits.create', compact('visitee', 'categories'));
    }

    /**
     * @param Request $request
     * @param         $visiteeId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request, $visiteeId) {

        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'visitee_id' => $visiteeId,
            'category_id' => $request->get('category_id')
        ];

        $visit = Visit::create($data);

        if ($request->has('note')) {
            $note = new \App\VisitNote(['note' => $request->get('note')]);
            $visit->notes()->save($note);
        }

        return redirect('/visitees')->with('success', 'You have successfully checked in!');
    }
}
