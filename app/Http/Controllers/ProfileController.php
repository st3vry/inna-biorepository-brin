<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\User;
use App\Models\Role;
use App\Models\Lab;
use Hash;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $role = Role::find(auth()->user()->role_id)->first();
        $lab = Lab::find(auth()->user()->role_id)->first();
        return view('dashboard.user.profile',[
            'role' => $role,
            'lab' => $lab
        ]);
    }
    
    public function update(Request $request, User $user)
    {
        $action = false;
        $rules = [
            'name' => 'required|max:255',
            'orcid_id' => 'max:255',
        ];

        $validatedData = $request->validate($rules);
        $action = User::where('id', auth()->id())->update($validatedData);
        if ($action) {
            ActionLog::create([
                'action' => 'updateProfileDetail',
                'type' => 'Profile',
                'item_id' => auth()->id(),
                'created_by' =>auth()->id(),
                'desc' => !isset($request->comment) ? null : $request->comment
            ]);
            return back()->with('success', 'Profile has been updated!');
        }
        return back()->with('error', 'Something went wrong, please try again later!');
    }


    public function password(Request $request) {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('current_password', 'Current password does not match!');
        }

        if(strcmp($request->current_password, $request->new_password) === 0){
            return back()->with("same_old_password","New Password cannot be same as your current password.");
        }
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|string|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $user->password = bcrypt($request->get('new_password'));
        if ($user->save()) {
            ActionLog::create([
                'action' => 'updatePassword',
                'type' => 'Profile',
                'item_id' => auth()->id(),
                'created_by' =>auth()->id(),
                'desc' => !isset($request->comment) ? null : $request->comment
            ]);
            return back()->with('success', 'Profile has been updated!');
        }
        return back()->with('error', 'Something went wrong, please try again later!');
    }
}
