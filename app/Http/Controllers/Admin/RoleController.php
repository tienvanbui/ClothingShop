<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
class RoleController extends Controller
{

    public function __construct()
    {
        $this->setModel(Role::class);
        $this->resourceName = 'roles';
        $this->modelName = 'Role';
        $this->views = [
            'index'=>'admin.role.index',
        ];
        $this->validateRule = [
            'role_name'=>'required|string|bail',
            'role_description'=>'required|string|bail',
            
        ];
        $this->modelName = "Role";
    }
    public function show(Role $role){
        $permission = Permission::where('parent_id',0)->get();
        $pemissionOfRole = $role->permissions()->get();
        return view('admin.role.show',[
            'role'=>$role,
            'pemissionOfRole'=>$pemissionOfRole,
            'permission'=>$permission,
        ]);
    }
    public function create(){
        $permissionLst = Permission::where('parent_id',0)->get();
        return view('admin.role.create')->with('permissionLst',$permissionLst);
    }
          /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        if($this->startValidationProcess($request)){
            $roleStore = Role::create([
                'role_name' => $request->role_name,
                'role_description' => $request->role_description,
            ]);
            $roleStore->permissions()->attach($request->permission_id);
            return redirect()->route('role.index')->withToastSuccess("$this->modelName Updated Successfully!");
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permission = Permission::where('parent_id',0)->get();
        $pemissionOfRole = $role->permissions;
        return view('admin.role.edit')->with([
            'role'=>$role,
            'permission'=>$permission,
            'pemissionOfRole'=>$pemissionOfRole
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if($this->startValidationProcess($request)){
            $role->update([
                'role_name'=>$request->role_name,
                'role_description' =>$request->role_description
            ]);
            $role->permissions()->sync($request->permission_id);
            return redirect()->route('role.index')->withToastSuccess("$this->modelName Updated Successfully!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        return redirect()->route('role.index')->withToastSuccess("$this->modelName Deleted successfully!");
    }
}
