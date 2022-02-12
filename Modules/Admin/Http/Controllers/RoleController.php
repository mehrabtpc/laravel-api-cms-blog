<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\Role\StoreRoleRequest;
use Modules\Admin\Http\Requests\Role\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
//roles ->created here
//permissions ->static
//role has permissions ->must create here

    public function index()
    {
        $roles=Role::query()->get();

        return response()->json([
            'roles' => $roles,
            'status' => 'success',
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $role=Role::create([
           'name' => $request->name,
            'guard_name'=> 'admin-api'
        ]);

        //permissions for this role
        $permissions = $request->permissions;

        foreach ($permissions as $permission){
            //give permission to role
            $role->givePermissionTo($permission);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'رول با موفقیت ساخته شد',
        ]);
    }

    public function show(Role $role)
    {
        return response()->json([
            'status' => 'success',
            'role' => $role,
        ]);

    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'رول با موفقیت ویرایش شد',
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'حساب با موفقیت حذف شد',
        ]);
    }
}
