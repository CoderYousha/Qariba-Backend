<?php

namespace App\Transformers\Requests;

use App\Transformers\Pagination\PaginationResponse;

class RequestsResponse
{
    public static function format($requests)
    {
        $data = ['requests' => []];

        foreach ($requests as $request) {
            $data['requests'][] = [
                'id' => $request->id,
                'description' => $request->description,
                'user' => $request->user,
                'category' => $request->category,
            ];
        }

        $data['pagination'] = PaginationResponse::format($requests);

        return $data;
    }
}
