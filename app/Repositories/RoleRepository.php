<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RoleInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    public function index(Request $request)
    {
        return Role::latest()->paginate(5);
    }

    public function create()
    {
        return Permission::get();
    }

    public function store(Request $request)
    {
        $permissionIds = $request->input('permission');
        $validPermissionIds = Permission::where('guard_name', 'web')
            ->whereIn('id', $permissionIds)
            ->pluck('id')
            ->toArray();
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($validPermissionIds);
        return true;
    }

    public function show(string $id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        return compact('role','rolePermissions');
    }

    public function edit(string $id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return compact('role','permission','rolePermissions');
    }

    public function update(Request $request, string $id)
    {
        $permissionIds = $request->input('permission');
        $validPermissionIds = Permission::where('guard_name', 'web')
            ->whereIn('id', $permissionIds)
            ->pluck('id')
            ->toArray();
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($validPermissionIds);
        return true;
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);
        if($role){
            $role->delete();
            $role->permissions()->detach();
        }
        return true;
    }
}
