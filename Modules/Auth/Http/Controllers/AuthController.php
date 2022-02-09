<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Check email
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'statue' => 'warning',
                'message' => 'یوزرنیم یا پسورد اشتباه است',
            ],422);
        }

        $token = $admin->createToken('myapptoken')->plainTextToken;

        return response()
            ->success('با موفقیت وارد شدید',
                compact('admin','token')
            ,201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->success('با موفقیت خارج شدید',''
            ,401);
    }

    public function showProfile(){
        $admin = auth()->user();
        return response()->success('',compact($admin));
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
            'message' => 'حساب با موفقیت حدف شد',
        ]);
    }
}
