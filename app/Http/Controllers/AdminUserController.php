<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Lab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.user.index', [

            // 'bioprojects' => Bioproject::with(['organism'])->get(),
            'users' => User::with('role', 'lab', 'lab.center')->where('is_activated', false)->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $roles = Role::all();
        $labs = Lab::all();
        return view('dashboard.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'labs' => $labs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $rules = [
            'name' => 'required|max:255',
            'orcid_id' => 'required|max:255',
            'lab_id' => 'required',
            'role_id' => 'required',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|max:255|unique:users';
        }
        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        $validatedData = $request->validate($rules);
        $validatedData['is_activated'] = $request->has('activate');

        User::where('id', $user->id)->update($validatedData);
        return redirect('/dashboard/users')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('success', 'User has been deleted!');
    }
    
    public function filter(Request $request)
    {   
        $data = User::with('role', 'lab', 'lab.center')->where('is_activated', false)->paginate(10);
        if ($request->filled('search')) {
            $search = $request->search;
            if ($request->entries > 0) {
                $data = User::with('role', 'lab', 'lab.center')
                    ->where('is_activated',false)
                    ->where(function($query) use ($search){
                        $query->orWhere('name', 'ilike' ,'%'.$search.'%')
                            ->orWhere('username',  'ilike' ,'%'.$search.'%')
                            ->orWhere('email',  'ilike' ,'%'.$search.'%');
                    })
                    ->orWhereRelation('role', 'name', 'ilike' ,'%'.$search.'%')
                    ->orWhereRelation('lab', 'name', 'ilike' ,'%'.$search.'%')
                    ->paginate($request->entries);
            } else {
                $data = User::with('role', 'lab', 'lab.center')
                    ->where('is_activated',false)
                    ->where(function($query) use ($search){
                        $query->orWhere('name', 'ilike' ,'%'.$search.'%')
                            ->orWhere('username',  'ilike' ,'%'.$search.'%')
                            ->orWhere('email',  'ilike' ,'%'.$search.'%');
                    })->get();
            }
        } else {
            if ($request->entries > 0) {
                $data = User::with('role', 'lab', 'lab.center')->where('is_activated', false)->paginate($request->entries);
            } else {
                $data = User::with('role', 'lab', 'lab.center')->where('is_activated', false)->get();
            }
        }


        return view('dashboard.user.table', [
            'users' => $data,
        ])->render();
    }
}
