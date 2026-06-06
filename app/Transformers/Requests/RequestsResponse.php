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
                'service' => $request->service,
                'category' => $request->category_id? $request->Category->category : $request->category,
                'sub_category' => $request->sub_category_id? $request->subCategory->sub_category : $request->sub_category,
                'created_at' => $request->created_at,
            ];
        }

        $data['pagination'] = PaginationResponse::format($requests);

        return $data;
    }
}
