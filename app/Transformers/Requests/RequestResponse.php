<?php

namespace App\Transformers\Requests;

class RequestResponse
{
    public static function format($request)
    {
        $data = [
            'request' => [
                'id' => $request->id,
                'description' => $request->description,
                'user' => $request->user,
                'service' => $request->service,
                'category' => $request->category_id ? $request->Category->category : $request->category,
                'sub_category' => $request->sub_category_id ? $request->subCategory->sub_category : $request->sub_category,
                'model' => $request->model ? $request->model->full_name : '',
                'status' => $request->status,
                'created_at' => $request->created_at,
            ]
        ];

        return $data;
    }
}
