<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Override;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'حقل الاسم مطلوب',
            'email.required' => 'حقل البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صالح',
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقا',
            'phone.required' => 'حقل رقم الهاتف مطلوب',
            'phone.numeric' => 'رقم الهاتف غير صالح',
            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 محارف',
            'password.confirmed' => 'خطأ في تأكيد كلمة المرور',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = [];

        foreach ($validator->errors()->all() as $error) {
            $errors[] = $error;
        }

        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'errors' => $errors
            ], 422)
        );
    }
}
