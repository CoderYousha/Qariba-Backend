<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Override;

class ProjectRequest extends FormRequest
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
            'sub_category_id' => 'required|exists:sub_categories,id',
            'title' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image',
            'client_name' => 'nullable',
            'project_url' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'sub_category_id.required' => 'الصنف الفرعي مطلوب',
            'category_id.exists' => 'الصنف غير متاح',
            'title.required' => 'حقل العنوان مطلوب',
            'description.required' => 'خقل الوصف مطلوب',
            'cover_image.required' => 'صورة الغلاف مطلوبة',
            'cover_image.image' => 'صورة الغلاف غير صالحة',
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
