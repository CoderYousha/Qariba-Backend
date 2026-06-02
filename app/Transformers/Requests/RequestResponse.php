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
                'sub_category' => $request->sub_category,
                'category' => $request->sub_category->category,
                'created_at' => $request->created_at,
            ]
        ];

        return $data;
    }
}
