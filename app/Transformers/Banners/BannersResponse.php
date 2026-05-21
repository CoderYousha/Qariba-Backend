<?php

namespace App\Transformers\Banners;

use App\Transformers\Pagination\PaginationResponse;
use Illuminate\Support\Facades\Auth;

class BannersResponse
{
    public static function format($banners)
    {
        $data = ['banners' => []];

        foreach ($banners as $banner){
            $data['banners'][] = [
                'id'=> $banner->id,
                'title' => $banner->title,
                'description' => $banner->description,
                'image' => $banner->image,
            ];
        }

        $data['pagination'] = PaginationResponse::format($banners);

        return $data;
    }
}
