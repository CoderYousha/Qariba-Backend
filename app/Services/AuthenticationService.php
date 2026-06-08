<?php

namespace App\Services;

use App\Mail\VerificationMessage;
use App\Models\User;
use App\Models\Verification;
use App\Transformers\Authentications\LoginResponse;
use App\Transformers\Authentications\ProfileResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationService
{
    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken('user')->plainTextToken;
            return success(LoginResponse::format($user, $token), 'تم تسجيل الدخول بنجاح');
        }

        return error('some thing went wrong', 'البريد الإلكتروني أو كلمة المرور غير صحيحة', 400);
    }

    public function profile()
    {
        $user = Auth::guard('user')->user();

        return success(ProfileResponse::format($user), 'معلومات الحساب');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('user')->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return success(null, 'تم تعديل كلمة المرور بنجاح');
        }

        return error('some thing went wrong', 'كلمة المرور المدخلة غير صحيحة');
    }

    public function logout()
    {
        Auth::guard('user')->user()->tokens()->delete();

        return success(null, 'تم تسجيل الخروج بنجاح');
    }

    public function updateProfile($data)
    {
        $user = Auth::guard('user')->user();
        if (isset($data['image'])) {
            if (File::exists($user->image)) {
                File::delete($user->image);
            }

            $data['image'] = uploadImage($data['image'], 'ProfileImage');
        }
        $user->update($data);

        return success(ProfileResponse::format($user), 'تم تعديل بيانات حسابك بنجاح');
    }

    public function register($request)
    {
        $verification = Verification::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
            'code' => rand(111111, 999999),
            'expiry_date' => Carbon::now()->addMinutes(15),
        ]);

        // try {
        //     Mail::to($verification->email)->send(new VerificationMessage($verification->code));
        // } catch (Exception $e) {
        //     $verification->delete();
        //     return error('some thing went wrong', 'Cannot send verification code, try arain later....', 422);
        // }

        $token = $verification->createToken('verification')->plainTextToken;

        return success($token, 'تم إرسال رمز التحقق إلى بريدك الإلكتروني', 201);
    }

    public function registerVerify($code)
    {
        $verification = Auth::guard('verification')->user();

        if ($verification && $code == $verification->code && Carbon::now() < $verification->expiry_date) {
            $user = User::create([
                'full_name' => $verification->full_name,
                'email' => $verification->email,
                'phone' => $verification->phone,
                'password' => $verification->password,
                'role' => $verification->role,
            ]);
            $token = $user->createToken('user')->plainTextToken;
            $verification->delete();

            return success(LoginResponse::format($user, $token), 'تم إنشاء الحساب بنجاح', 201);
        }

        return error('something went wrong', 'رمز التحقق غير صالح');
    }

    public function forgetPassword($email)
    {
        $verification = Verification::create([
            'email' => $email,
            'code' => rand(111111, 999999),
            'expiry_date' => Carbon::now()->addMinutes(15),
        ]);

        try {
            Mail::to($verification->email)->send(new VerificationMessage($verification->code));
        } catch (Exception $e) {
            $verification->delete();
            return error('some thing went wrong', 'Cannot send verification code, try arain later....', 422);
        }

        $token = $verification->createToken('verification')->plainTextToken;

        return success($token, 'قمنا بإرسال رمز التحقق إلى بريدك الإلكتروني', 201);
    }

    public function forgetPasswordVerify($code)
    {
        $verification = Auth::guard('verification')->user();

        if ($verification && $code == $verification->code && Carbon::now() < $verification->expiry_date) {
            $user = User::where('email', $verification->email)->first();
            $token = $user->createToken('reset-password')->plainTextToken;
            $verification->delete();

            return success($token, 'تم التأكد بنجاح');
        }

        return error('something went wrong', 'رمز التحقق غير صالح');
    }

    public function resetForgetPassword($request)
    {
        $user = Auth::guard('reset-password')->user();

        if ($user) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            $user->tokens()->delete();

            return success(null, 'تم إعادة ضبط كلمة المرور بنجاح');
        }
        return error('some thing went wrong', 'Forbidden', 403);
    }
}
