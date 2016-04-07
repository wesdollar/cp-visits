<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\UserSetting;
use App\UsState;
use Auth;
use CP\API;
use Illuminate\Http\Request;

use App\Http\Requests;

class GroupsController extends Controller
{

    public function index(Request $request) {

        $api = new API();
        $api->auth($request);

        $user = Auth::user();

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

        $api = new API();
        $api->auth($request);

        $user = Auth::user();

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

        $api = new API();
        $api->auth($request);

        $user = Auth::user();

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

        $api = new API();
        $api->auth($request);

        $user = Auth::user();

        $user->groups()->detach($groupId);

        Group::destroy($groupId);

        $data = [
            'success' => true,
            'message' => 'Group has been deleted successfully.'
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

    public function joinGroup($groupId = null) {

        $user = Auth::user();

        if ($groupId) {

            // if user is already attached to the provided group,
            // do not attach a second time

            if ($group = $user->groups()->find($groupId)) {
                return redirect()->back()->with('success', 'You already belong to '.$group->name.'!');
            }
            else {
                $user->groups()->attach($groupId);
            }

            return redirect()->back()->with('success', 'You have been added to the group!');

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

}
