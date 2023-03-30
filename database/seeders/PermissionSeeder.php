<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = config('permissions.modul');
        $adminRole = (User::where('role_id',1)->firstOrFail())->role;
        $userRole = (User::where('role_id',2)->firstOrFail())->role;
        foreach($module as $parentPermission){
            $role_permission_admin = [];
            $permission = Permission::create(
                [
                    'permission_name'=>$parentPermission,
                    'permission_description'=>ucwords($parentPermission),
                    'parent_id'=>0
                ]
            );
            foreach (config('permissions.modul_features') as  $childPermission) {
                $child = Permission::create([
                 'permission_name'=> $childPermission . ' '.$parentPermission,
                 'permission_description'=>$childPermission. ' '.ucwords($parentPermission),
                 'parent_id'=>$permission->id,
                 'key_code'=>$parentPermission.'_'.$childPermission,
                ]);
                array_push($role_permission_admin,$child->id);
            }
            $adminRole->permissions()->attach($role_permission_admin);
        }
       
        
    }
}
