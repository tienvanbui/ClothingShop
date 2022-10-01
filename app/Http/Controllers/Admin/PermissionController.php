<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
class PermissionController extends Controller
{
    public function __construct()
    {
        
        $this->setModel(Permission::class);
        $this->resourceName='permissions';
        $this->modelName='Permission';
        $this->views = [
            'create' => 'admin.permission.create',
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
            $permission = Permission::create(
                [
                    'permission_name'=>$request->permission_name,
                    'permission_description'=>ucwords($request->permission_name),
                    'parent_id'=>0
                ]
            );
            foreach ($request->modulFeatures as  $value) {
               Permission::create([
                'permission_name'=> $value . ' '.$request->permission_name,
                'permission_description'=>$value. ' '.ucwords($request->permission_name),
                'parent_id'=>$permission->id,
                'key_code'=>$request->permission_name.'_'.$value,
               ]);
            }
            return redirect()->route('permission.create')->withToastSuccess('Quyền lưu trữ thành công!');
    }
}