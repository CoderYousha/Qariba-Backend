<?php

namespace App\Transformers\Banners;

use App\Transformers\Pagination\PaginationResponse;
use Illuminate\Support\Facades\Auth;

class ClientsResponse
{
    public static function format($clients)
    {
        $data = ['clients' => []];

        foreach ($clients as $client){
            $data['clients'][] = [
                'id'=> $client->id,
                'image' => $client->image,
            ];
        }

        return $data;
    }
}
