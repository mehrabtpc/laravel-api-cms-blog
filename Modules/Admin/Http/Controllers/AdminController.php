<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\Admin\StoreAdminRequest;
use Modules\Admin\Http\Requests\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    public function index(){
        $admins= Admin::all();

        return response()->json([
            'status' => 'success',
            'admins' => $admins,
        ]);
    }

    public function show(Admin $admin){

        return response()->json([
            'status' => 'success',
            'admin' => $admin,
        ]);
    }

    public function storeUser(StoreAdminRequest $request)
    {
        $admin =Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' =>bcrypt($request->password),
        ]);
        $role=$request->role;
        $admin->assignRole($role);

        $token = $admin->createToken('token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'admin' => $admin,
            'token' => $token,
        ],201);
    }

    public function update(UpdateAdminRequest $request,Admin $admin){

        $admin->update([
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' =>bcrypt($request->password),
        ]);

        $role=$request->role;
        if($role){
            $admin->assignRole($role);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'حساب با موفقیت ویرایش شد',
        ],201);
    }

    public function delete(Admin $admin){
        $admin->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'حساب با موفقیت حذف شد',
        ],201);
    }
}
