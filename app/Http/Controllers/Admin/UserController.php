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
        $this->validateRule = [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|email',
            'address' => 'required|max:255',
            'phoneNumber' => 'required|numeric',
            'status' => 'required',
        ];
        $this->messageValidate = [
            'name.required' => 'Trường này không được để trống',
            'username.required' => 'Trường này không được để trống',
            'role_id.required' => 'Trường này chưa được chọn',
            'email.required' => 'Trường này không được để trống',
            'address.required' => 'Trường này không được để trống',
            'status.required' => 'Trường này không được để trống',
            'phoneNumber.required' => 'Trường này không được để trống',
            'phoneNumber.numeric' => 'Trường này phải là định dạng số',
            'name.max' => 'Tối đa 255 ký tự',
            'username.max' => 'Tối đa 255 ký tự',
            'role_id.max' => 'Tối đa 255 ký tự',
            'email.max' => 'Tối đa 255 ký tự',
            'email.email' => 'Phải có định dạng email',
            'role_id.exists' => 'Vai trò không tồn tại',
        ];
        $this->middleware(['permission:User_list'], ['only' => ['index']]);
        $this->middleware(['permission:User_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:User_show'], ['only' => ['show']]);
        $this->middleware(['permission:User_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:User_delete'], ['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate($this->validateRule, $this->messageValidate);
        if ($validator) {
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
            return redirect()->route('manage_user.index')->withToastSuccess("Tạo tài khoản thành công!");
        }
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
        $validator = $request->validate($this->validateRule, $this->messageValidate);
        if ($validator) {
            $manage_user->delete();
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phoneNumber = $request->phoneNumber;
            $user->address = $request->adrress;
            $user->status = $request->status;
            $user->role_id = $request->role_id;
            $user->save();
            return redirect()->route('manage_user.index')->withToastSuccess("Cập nhật tài khoản thành công!");
        }
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
        return redirect()->route('manage_user.index')->withToastSuccess("Xóa tài khoản thành công!");;
    }
}
