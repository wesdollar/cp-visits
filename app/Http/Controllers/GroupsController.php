<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\UserSetting;
use App\UsState;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class GroupsController extends Controller
{

    public function index() {

        $user = Auth::user();

        return view('groups.list', compact('user'));
    }

    public function getCreate() {

        $usStates = UsState::all();

        return view('groups.create', compact('usStates'));
    }

    public function postCreate(Request $request) {

        $user = Auth::user();

        $group = Group::create($request->all());
        $user->groups()->attach($group->id);

        return redirect('/groups')->with('success', 'Your group has been created!');
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
        $groups = Group::where('active', true)->get(['name']);

        return $groups;
    }

    public function joinGroup($groupId = null) {

        $user = Auth::user();

        if ($groupId) {

            $user->groups()->attach($groupId);

            return redirect()->back()->with('success', 'You have been added to the group!');

        }

        $groups = Group::where('groups.active', true)
            ->where('group_user.user_id', '!=', $user->id)
            ->join('group_user', 'groups.id', '=', 'group_user.group_id')
            ->get();

        return view('groups.join', compact('groups'));
    }

}
