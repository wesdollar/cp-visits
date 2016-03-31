<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\CreateVisiteeRequest;
use App\UsState;
use App\Visit;
use App\Visitee;
use App\VisiteeCategory;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

class VisiteesController extends Controller
{

    /*public function __construct() {
        $this->middleware('auth');
    }*/

    public function index(Request $request) {

        $user = Auth::user();

        // redirect to groups page and display error message if the user does not belong to a group
        if ($user->groups->count() < 1) {
            return redirect('/groups')->with('error', 'You do not belong to any groups. Please request to join an existing group by searching for the group below and create a new group.');
        }

        return view('visitees.list', compact('user'));
    }

    public function getCreate() {

        $user = Auth::user();
        $groups = $user->groups;

        // todo: refactor for easy reuse
        $userDefaultGroup = ($user->settings->where('name', 'default_group')->first()->value) ? $user->settings->where('name', 'default_group')->first()->value : null;

        $usStates = UsState::all();

        $categories = VisiteeCategory::where('active', true)->get();

        return view('visitees.create', compact('usStates', 'groups', 'userDefaultGroup', 'categories'));
    }

    public function postCreate(Request $input, CreateVisiteeRequest $request) {

        $visitee = Visitee::create($input->except('group'));

        $visitee->groups()->attach($input->get('group'));

        return redirect('/visitees')->with('success', 'The visitee you created has been added below!');
    }

    public function checkIn($id) {
        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'visitee_id' => $id,
        ];

        Visit::create($data);

        return redirect('/visitees')->with('success', 'You have been successfully checked in!');
    }
}
