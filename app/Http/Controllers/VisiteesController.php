<?php

namespace App\Http\Controllers;

use App\CheckinType;
use App\Group;
use App\Http\Requests\CreateVisiteeRequest;
use App\UsState;
use App\Visit;
use App\Visitee;
use App\VisiteeCategory;
use App\VisitNote;
use Auth;
use Carbon\Carbon;
use CP\API;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class VisiteesController extends Controller
{

    protected $api;

    public function __construct() {
        $this->api = new API();
    }

    public function index(Request $request) {

        $user = $this->api->verifyToken($request);

        // todo: refactor
        // count visitees in all groups
        $iVisitees = 0;

        foreach ($user->groups as $group) {
            $j = $group->visitees->count();

            $iVisitees = $iVisitees + $j;
        }

        // return ajax results
        if ($request->ajax()) {
            return $this->returnAjaxResults($user);
        }

        // response for standard web-app
        else {
            // redirect to groups page and display error message if the user does not belong to a group
            if ($user->groups->count() < 1) {
                return redirect('/groups')->with('error', 'You do not belong to any groups. Please request to join an existing group by searching for the group below and create a new group.');
            }

            return view('visitees.list', compact('user', 'iVisitees'));
        }

    }

    public function getCreate(Request $request) {

        $user = $this->api->verifyToken($request);

        $groups = $user->groups;

        // todo: refactor for easy reuse
        $userDefaultGroup = (($user->settings->where('name', 'default_group')->first()) ? $user->settings->where('name', 'default_group')->first()->value : null);

        $usStates = UsState::all();

        $categories = VisiteeCategory::where('active', true)->get();

        return view('visitees.create', compact('usStates', 'groups', 'userDefaultGroup', 'categories'));
    }

    public function postCreate(Request $input, CreateVisiteeRequest $request) {

        $user = $this->api->verifyToken($input);

        $visitee = Visitee::create($input->except('group'));

        $visitee->groups()->attach($input->get('group'));

        return redirect('/visitees')->with('success', 'The visitee you created has been added below!');
    }

    public function checkIn(Request $request, $id) {

        $user = $this->api->verifyToken($request);

        $data = [
            'user_id' => $user->id,
            'visitee_id' => $id,
            'category_id' => $request->json('type')
        ];

        $visit = Visit::create($data);

        if ($request->json('message')) {

            $data = [
                'note' => $request->json('message'),
                'image' => $request->json('image'),
            ];

            $note = new VisitNote($data);
            $visit->notes()->save($note);
        }

        // handle ajax response
        if ($request->ajax()) {

            return response()->json([
                'success' => true,
                'message' => 'You checked in successfully!',
                'note' => $request->json('message'),
                'category_id' => $request->json('type'),
                'image' => $request->json('image'),
                'visit' => $visit
            ]);
        }

        return redirect('/visitees')->with('success', 'You have been successfully checked in!');
    }

    public function remove($id) {
        $visitee = Visitee::find($id);
        $visitee->delete();

        return redirect('visitees')->with('success', $visitee->first . ' has been removed from your list.');
    }

    public function getEdit($id) {

        $user = Auth::user();
        $groups = $user->groups;

        // todo: refactor for easy reuse
        $userDefaultGroup = (($user->settings->where('name', 'default_group')->first()) ? $user->settings->where('name', 'default_group')->first()->value : null);

        $usStates = UsState::all();

        $categories = VisiteeCategory::where('active', true)->get();

        $visitee = Visitee::findOrFail($id);

        return view('visitees.edit', compact('visitee', 'groups', 'usStates', 'categories', 'userDefaultGroup'));
    }

    public function postEdit(Request $request) {

        $visitee = Visitee::findOrFail($request->id);

        // detach from existing group so we can save them to the group provided on post
        $visitee->groups()->detach();

        // update visitee
        $visitee->update($request->except('id', 'group'));

        // attach to group
        $visitee->groups()->attach($request->get('group'));

        return redirect('visitees')->with('success', $request->first . '\'s details have been updated!');
    }

    public function getVisitee(Request $request, $visiteeId) {

        $user = $this->api->verifyToken($request);

        $visitee = Visitee::find($visiteeId);

        $visits = $visitee->visits;

        foreach ($visits as $visit) {
            $visit->notes;
            $visit->user;
        }

        return $this->visiteeTransformer($visitee, $user);
    }

    // todo: refactor (duplicate "method" postCreate = postVisitee)
    public function postVisitee(Request $request) {

        $user = $this->api->verifyToken($request);

        $data = $this->transformVisiteeInput($request);

        $visitee = Visitee::create($data);

        $visitee->groups()->attach($request->get('GroupId'));

        $data = [
            'success' => true,
            'message' => $visitee->first . ' has been added successfully!',
            'visiteeId' => (string) $visitee->id
        ];

        // return all groups
        return $this->returnAjaxResults($user, $data);
    }

    public function putVisitee(Request $request, $visiteeId) {

        $user = $this->api->verifyToken($request);

        $visitee = Visitee::findOrFail($visiteeId);

        // detach from existing group so we can save them to the group provided on post
        $visitee->groups()->detach();

        // update visitee
        $data = $this->transformVisiteeInput($request);

        $visitee->update($data);

        // attach to group
        $visitee->groups()->attach($request->get('GroupId'));

        $data = [
            'success' => $visitee->first . '\'s information has been updated successfully!'
        ];

        return $data;
    }

    public function deleteVisitee(Request $request, $visiteeId) {

        $user = $this->api->verifyToken($request);

        $visitee = Visitee::find($visiteeId);

        if (!$visitee) {

            $error = [
                'error' => [
                    'isError' => true,
                    'message' => 'Visitee not found!'
                ],
                'success' => false,
            ];

            return $error;
        }

        $name = $visitee->first;

        $visitee->delete();

        $data = [
            'success' => true,
            'message' => $name . ' has been removed.'
        ];

        return $data;
    }

    private function visiteeTransformer($visitee, $user) {

        $data = [
            'id' => $visitee->id,
            'visiteeId' => $visitee->id,
            'first' => $visitee->first,
            'last' => $visitee->last,
            'address' => $visitee->address,
            'city' => $visitee->city,
            'state' => $visitee->state,
            'zip' => $visitee->zip,
            'phone' => $this->formatPhone($visitee->phone),
            'email' => $visitee->email,
            'visiteeType' => VisiteeCategory::find($visitee->category_id)->name,
            'visiteeTypeId' => (string) $visitee->category_id,
            'groupId' => (string) $visitee->groups->first()->id,
            'visits' => $this->visitsTransformer($visitee->visits),
            'userCheckedIn' => $this->userCheckedInToday($visitee, $user)
        ];

        return $data;
    }

    private function visitsTransformer($visits) {

//        return $visits;

        $data = array_map(function($visit) {
            return [
                'visitId' => $visit['id'],
                // 'M d, Y \a\t g:ia'
                'dateOfVisit' => Carbon::parse($visit['created_at'])->format('M j, Y'),
                'visitType' => CheckinType::find($visit['category_id'])['name'],
                'notes' => $this->notesTransformer($visit['notes']),
                'visitor' => $this->visitorTransformer($visit['user']),

            ];
        }, $visits->toArray());

        return $data;
    }

    private function visitorTransformer($user) {

        $data = [
            // 'userId' => $user['id'],
            'firstName' => $user['first'],
            'lastName' => $user['last'],
        ];

        return $data;
    }

    private function notesTransformer($notes) {

        $data = array_map(function($note) {
            return [
                'message' => $note['note'],
                'image' => $note['image'],
            ];
        }, $notes);

        return $data;
    }

    /**
     * @param $visitee
     * @param $user
     *
     * @return mixed
     */
    private function userCheckedInToday($visitee, $user) {
        return (Visit::where('user_id', '=', $user->id)->
            where('visitee_id', '=', $visitee->id)->
            whereBetween('created_at', [Carbon::today(), Carbon::now()])->
            first()) ? true : false;
    }

    private function formatPhone($phone) {

        if ($phone == '') {
            return null;
        }
        else {
            $phone = str_replace('+1', '', $phone);
            $phone = str_replace('+0', '', $phone);
            // $phone = preg_replace('/[^0-9]/', '', $phone);
            $phone = str_replace('-', '', $phone);
            $phone = str_replace('(', '', $phone);
            $phone = str_replace(')', '', $phone);

            return "(".substr($phone,0,3).") ".substr($phone,3,3)."-".substr($phone,6);
        }

    }

    /**
     * @param Request $request
     *
     * @return array
     */
    private function transformVisiteeInput(Request $request) {
        $data = [
            'first'       => $request->get('FirstName'),
            'last'        => $request->get('LastName'),
            'address'     => $request->get('Address'),
            'city'        => $request->get('City'),
            'state'       => $request->get('State'),
            'zip'         => $request->get('Zip'),
            'email'       => $request->get('Email'),
            'phone'       => $request->get('Phone'),
            'category_id' => $request->get('VisiteeTypeId'),
            'address_desc' => $request->get('AddressDesc'),
        ];

        return $data;
    }

    private function returnAjaxResults($user, $data=null) {

        if ($data) {
            $data = [$data];
        }
        else {
            $data = [];
        }

        foreach ($user->groups as $group) {

            foreach ($group->visitees as $visitee) {
                $visitee->visits;
            }

            array_push($data, $group);

        }

        return response()->json($data);
    }

}
