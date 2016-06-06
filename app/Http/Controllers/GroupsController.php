<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupOwner;
use App\JoinRequest;
use App\User;
use App\UserSetting;
use App\UsState;
use Auth;
use CP\API;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class GroupsController extends Controller
{

    protected $api;

    public function __construct() {
        $this->api = new API();
    }

    public function index(Request $request) {

        $user = $this->api->verifyToken($request);

        // return ajax results
        if ($request->ajax()) {
            $data = [];

            foreach ($user->groups as $group) {

                array_push($data, $group);

            }

            return response()->json($data);
        }

        else {
            return view('groups.list', compact('user'));
        }
    }

    public function getGroup(Request $request, $groupId) {

        $api = new API();
        $api->auth($request);

        $user = Auth::user();

        $group = Group::findOrFail($groupId);

        return $group;
    }

    public function getCreate() {

        $usStates = UsState::all();

        return view('groups.create', compact('usStates'));
    }

    public function postCreate(Request $request) {

        $user = $this->api->verifyToken($request);

        if ($request->ajax()) {
            $data = [
                'name' => $request->get('Name'),
                'city' => $request->get('City'),
                'state' => $request->get('State'),
                'zip' => $request->get('Zip'),
                'public' => $request->get('Public')
            ];
        }
        else {
            $data = [
                'name' => $request->get('name'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip' => $request->get('zip'),
                'public' => ($request->has('public')) ? true : false,
            ];
        }

        $group = Group::create($data);

        $user->groups()->attach($group->id);

        // add user as group owner
        GroupOwner::create(['group_id' => $group->id, 'user_id' => $user->id]);

        if ($request->ajax()) {

            $data = [
                'success' => true,
                'message' => 'Group ' . $group->name . ' has been created successfully!',
                'groupId' => $group->id
            ];

            return $data;
        }
        else {
            return redirect('/groups')->with('success', 'Your group has been created!');
        }
    }

    public function update(Request $request, $groupId) {

        $user = $this->api->verifyToken($request);

        $data = $request->except('id');

        $group = Group::findOrFail($groupId);

        $group->name = $data['name'];
        $group->city = $data['city'];
        $group->state = $data['state'];
        $group->zip = $data['zip'];
        $group->public = $data['public'];

        $group->save();

        $data = [
            'success' => true,
            'message' => $group->name . ' has been updated successfully!'
        ];

        return $data;
    }

    public function delete(Request $request, $groupId) {

        $user = $this->api->verifyToken($request);

        $user->groups()->detach($groupId);

        $group = Group::findOrFail($groupId);

        // save group name for returning in message before we delete it
        $groupName = $group->name;
        $group->delete();

        $data = [
            'success' => true,
            'message' => $groupName . ' has been deleted successfully.'
        ];

        return $data;
    }

    public function setDefaultGroup($groupId) {

        $user = Auth::user();

        $userDefaultGroupSetting = $user->settings->where('name', 'default_group')->first();

        if (isset($userDefaultGroupSetting->value) && ($userDefaultGroupSetting->value != null)) {

            $userDefaultGroupSetting->value = $groupId;
            $userDefaultGroupSetting->save();

            return redirect()->back()->with('success', 'Your default group has been updated!');
        }

        else {
            $data = [
                'name' => 'default_group',
                'value' => $groupId,
                'user_id' => $user->id
            ];

            UserSetting::create($data);

            return redirect('/groups')->with('success', 'Your default group has been updated!');
        }

    }

    public function returnAllGroups() {

        // initial index
        $groups = Group::all()->sortBy('name');

        foreach ($groups as $group) {
            $group->pushToIndex();
        }

        return $groups;

//        return Group::setSettings();
    }

    public function joinGroup(Request $request, $groupId = null) {

        $user = Auth::user();

        if ($groupId) {

            // if user is already attached to the provided group,
            // do not attach a second time

            if ($group = $user->groups()->find($groupId)) {

                $youAlreadyBelong = 'You already belong to '.$group->name.'!';

                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => $youAlreadyBelong
                    ], 304);
                }

                return redirect()->back()->with('success', $youAlreadyBelong);
            }
            else {
                // $user->groups()->attach($groupId);

                // find owner of group
                if (! $groupOwner = GroupOwner::where('group_id', $groupId)->first()) {

                    $noOwnerHere = 'The group you requested to join does not have an owner. Please try again.';

                    if ($request->ajax()) {

                        return response()->json([
                            'success' => false,
                            'message' => $noOwnerHere
                        ], 304);
                    }

                    return redirect()->back()->with('error', $noOwnerHere);
                }

                // unique request code
                $code = $this->uniqueRequestCode();

                // create join request with unique code
                $data = [
                    'group_id' => $groupId,
                    'user_id' => $user->id,
                    'owner_id' => $groupOwner->user_id,
                    'code' => $code
                ];

                JoinRequest::create($data);

                $data = [
                    'user' => $user,
                    'recipient' => User::find($groupOwner->user_id),
                    'group' => Group::find($groupId),
                    'code' => $code,
                ];

                // dispatch email to group owner with unique code
                Mail::queue('emails.groups.requestToJoin', $data, function ($message) use ($data) {

                    $message->from($data['user']->email, $data['user']->first . ' ' . $data['user']->last);
                    $message->to($data['recipient']->email);
                    $message->subject('Visit List Join Request');

                });

            }

            $successMsg = 'Your request to join the group has been sent to the group owner!';

            // return ajax results for API
            if ($request->ajax()) {

                $data = [
                    'success' => true,
                    'message' => $successMsg
                ];

                return response()->json($data);
            }

            return redirect()->back()->with('success', $successMsg);
        }

        // return error if no/invalid group
        if ($request->ajax()) {
            $data = [
                'success' => false,
                'status' => 400,
                'message' => 'missing_invalid_list',
            ];

            return response()->json($data);
        }

        $groups = Group::where('groups.active', true)
            ->where('group_user.user_id', '!=', $user->id)
            ->join('group_user', 'groups.id', '=', 'group_user.group_id')
            ->get();

        return view('groups.join', compact('groups'));
    }

    public function removeFromGroup($id) {

        $group = Group::findOrFail($id);

        $user = Auth::user();
        $user->groups()->detach($group->id);

        return redirect('/groups')->with('success', 'You have been removed from '.$group->name.'!');
    }

    public function share(Request $request, $groupId) {

        $request->session()->flash('shareGroupCheckId', $groupId);

        return view('groups.share', compact('groupId'));
    }

    public function sendShareEmails(Request $request, $groupId) {

        // match session('shareGroupCheckId') with given $groupId
        if (! $request->session()->get('shareGroupCheckId') == $groupId) {

            // todo: redirect with error message
            dd('Error! Group ID mismatch. Please try again.');
        }

        // todo: error message if group does not exit
        $group = Group::findOrFail($groupId);

        $user = Auth::user();

        // get and/or create group code
        if (($group->code == 'NULL') || ($group->code == NULL)) {

            $shareCode = $this->uniqueCode();

            $group->code = $shareCode;
            $group->save();
        }
        else {
            $shareCode = $group->code;
        }

        $data = [
            'shareCode' => $shareCode,
            'user' => $user,
        ];

        // send email to each recipient
        foreach ($request->get('email') as $email) {

            Mail::queue('emails.groups.share', $data, function ($message) use ($data, $email) {

                $message->from($data['user']->email, $data['user']->first . ' ' . $data['user']->last);
                $message->to($email);
                $message->subject('Visit List Invite');

            });

        }

        return redirect('/groups')->with('success', 'As email has been sent containing a link to subscribe to your visitation list!');
    }

    public function approveJoinRequest(Request $request, $code) {

        $joinRequest = JoinRequest::where('code', $code)->first();

        $user = User::find($joinRequest->user_id);

        // do not attach if user already belongs to group
        if ($user->groups()->find($joinRequest->group_id)) {
            return redirect('/groups')->with('success', 'Request to join list has been approved!');
        }

        $user->groups()->attach($joinRequest->group_id);

        $joinRequest->delete();

        return redirect('/groups')->with('success', 'Request to join list has been approved!');
    }

    protected function uniqueCode() {

        $code = str_random(12);

        if (Group::where('code', $code)->count() < 1) {
            return $code;
        }
        else {
            return $this->uniqueCode();
        }

    }

    protected function uniqueRequestCode() {

        $code = str_random(20);

        if (JoinRequest::where('code', $code)->count() < 1) {
            return $code;
        }
        else {
            return $this->uniqueRequestCode();
        }

    }

}
