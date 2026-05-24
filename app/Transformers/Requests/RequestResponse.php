<?php

namespace App\Transformers\Requests;

class RequestResponse {
    public static function format ($request) {
        $data = [
            'request' => [
                'id' => $request->id,
                'image' => $request->description,
                'user' => $request->user,
                'category' => $request->category,
            ]
        ];

        return $data;
    }
}