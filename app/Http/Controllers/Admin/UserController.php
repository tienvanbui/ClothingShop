<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
class UserController extends Controller
{
    public function __construct()
    {

        $this->setModel(User::class);
        $this->resourceName = 'users';
        $this->modelName = 'User';
        $this->views = [
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'edit' => 'admin.user.edit',
        ];
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'email' => $request->email,
            'address' => $request->adrress,
            'phoneNumber' => $request->phoneNumber,
            'status' => $request->status,
        ]);
        return redirect()->route('manage_user.index')->with('message-success', "$this->modelName Stored Successfully!");
    }
    public function create()
    {
        $roles = Role::all();
        return view($this->views['create'], ['roles' => $roles]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $manage_user)
    {
        $roles = Role::all();
        $roleOfUser = $manage_user->role()->get();
        return view('admin.user.edit', [
            'user' => $manage_user,
            'roles' => $roles,
            'roleOfUser' => $roleOfUser,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $manage_user)
    {
        $manage_user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'adrress' => $request->adrress,
            'status' => $request->status,
            'role_id' => $request->role_id,
        ]);
        return redirect()->route('manage_user.index')->with('message-success', "$this->modelName Updated Successfully!");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $manage_user)
    {
        $manage_user->delete();
        return redirect()->route('manage_user.index')->with('message-success', "$this->modelName Deleted Successfully!");;
    }
}
