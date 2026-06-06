<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Override;

class OrderRequest extends FormRequest
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
            'service' => 'required',
            'category_id' => 'exists:categories,id|required_without:category',
            'sub_category_id' => 'exists:sub_categories,id|required_without:sub_category',
            'category' => 'required_without:category_id',
            'sub_category' => 'required_without:sub_category_id',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'service.required' => 'الخدمة مطلوبة',
            'category_id.exists' => 'الصنف غير متاح',
            'category_id.required_without' => 'الصنف مطلوب',
            'category.required_without' => 'الصنف مطلوب',
            'sub_category_id.exists' => 'الصنف الفرعي غير متاح',
            'sub_category_id.required_without' => 'الصنف الفرعي مطلوب',
            'sub_category.required_without' => 'الصنف الفرعي مطلوب',
            'description.required' => 'حقل الوصف مطلوب',
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
