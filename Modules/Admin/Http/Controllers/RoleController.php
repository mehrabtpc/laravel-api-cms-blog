<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\StoreRoleRequest;
use Modules\Admin\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
//roles
//permissions
//role has permissions

    public function index()
    {
        $roles=Role::query()->get();


        return response()->json([
            compact('roles')
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $role=Role::create([
           'name' => $request->name,
            'guard_name'=> 'admin_api'
        ]);
        //if(has permision){
        // //}
    }

    public function show(Role $roles)
    {
//        $roles=Role::find($id);

        return response()->json([
            compact('roles')
        ]);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role=Role::find($id);

        $role->update([
            'name' => $request->name,
        ]);
    }

    public function destroy($id)
    {
        $role=Role::find($id);

        $role->delete();
    }
}
