<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Override;

class BannerRequest extends FormRequest
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
            'title' => 'required',
            'descrription'=> 'required',
            'image' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'حقل العنوان مطلوب',
            'description.required' => 'حقل الوصف مطلوب',
            'image.required' => 'الصورة مطلوبة',
            'image.image' => 'الصورة غير صالحة',
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
