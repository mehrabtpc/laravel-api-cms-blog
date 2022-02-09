<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\Admin\StoreAdminRequest;
use Modules\Admin\Http\Requests\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    public function index(){
        $admins= Admin::all();

        return response()->success('', compact('admins'));

    }

    public function show(Admin $admin){

        return response()->success('', compact('admin'));

    }

    public function register(StoreAdminRequest $request)
    {
        $admin =Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' =>bcrypt($request->password),
        ]);

        $role = Role::query()->where('name','user')->get();
        $admin->assignRole($role);

        $token = $admin->createToken('myapptoken')->plainTextToken;

        return response()
            ->success('success',
            compact('admin','token'),
            201);
    }

    public function registerUser($request){
        $admin =Admin::query()->create([
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' =>bcrypt($request->password),
        ]);

        $role = Role::query()->where('name','admin')->get();
        $admin->assignRole($role);

        $token = $admin->createToken('myapptoken')->plainTextToken;

        return response()
            ->success('حساب با موفقیت ساخته شد',
            compact('admin','token')
            ,201);
    }

    public function update(UpdateAdminRequest $request,Admin $admin){

        $admin->update([
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' =>bcrypt($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'حساب با موفقیت ویرایش شد',
        ]);
    }

    public function delete(Admin $admin){

        $admin->delete();
        return response()->success('Deleted SuccessFully', '');

    }
}
