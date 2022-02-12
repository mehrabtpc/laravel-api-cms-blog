<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\Admin\StoreAdminRequest;
use Modules\Auth\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Check email
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {

            return response()->json([
                'status' => 'warning',
                'message' => 'یوزرنیم یا پسورد اشتباه است',
            ], 422);
        }

        $token = $admin->createToken('token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'با موفقیت وارد شدید',
            'admin' => $admin,
            'token' => $token,
        ],201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'با موفقیت خارج شدید',
        ]);
    }

    public function register(StoreAdminRequest $request){
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

        return response()->json([
            'status' => 'success',
            'message' => 'یوزر با موفقیت ساخته شد',
            'admin' => $admin,
            'token' => $token,
        ],201);
    }

    public function showProfile(){

        $admin = auth()->user();
        return response()->json([
            'status' => 'success',
            'admin' => $admin,
        ]);
    }

    public function editProfile(Request $request)
    {
        $admin = auth()->user();
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

    public function deleteProfile(){
        $admin = auth()->user();
        $admin->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'حساب با موفقیت حذف شد',
        ]);
    }
}
