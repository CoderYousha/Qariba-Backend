<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Override;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'حقل كلمة المرور مطلوب',
            'new_password.required' => 'حقل كلمة المرور الجديدة مطلوب',
            'new_password.min' => 'يجب أن تكون كلمة المرور على الأقل 8 محارف',
            'new_password.confirmed' => 'يجب تأكيد كلمة المرور',
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
