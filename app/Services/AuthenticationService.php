<?php

namespace App\Services;

use App\Models\User;
use App\Transformers\Authentications\LoginResponse;
use App\Transformers\Authentications\ProfileResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService {
    public function login ($email, $password){
        $user = User::where('email', $email)->first();

        if($user && Hash::check($password, $user->password)){
            $token = $user->createToken('user')->plainTextToken;
            return success(LoginResponse::format($user, $token), 'تم تسجيل الدخول بنجاح');
        }

        return error('some thing went wrong', 'البريد الإلكتروني أو كلمة المرور غير صحيحة', 400);
    }

    public function profile () {
        $user = Auth::guard('user')->user();

        return success(ProfileResponse::format($user), 'معلومات الحساب');
    }

    public function updatePassword (Request $request){
        $user = Auth::guard('user')->user();

        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return success(null, 'تم تعديل كلمة المرور بنجاح');
        }
    }

    public function logout (){
        Auth::guard('user')->user()->tokens()->delete();

        return success(null, 'تم تسجيل الخروج بنجاح');
    }

    public function updateProfile ($data){
        $user = Auth::guard('user')->user();
        $user->update($data);

        return success(ProfileResponse::format($user), 'تم تعديل بيانات حسابك بنجاح');
    }
}