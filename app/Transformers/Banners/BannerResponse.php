<?php

namespace App\Transformers\Banners;

class BannerResponse {
    public static function format ($banner) {
        $data = [
            'data' => [
                'id' => $banner->id,
                'title' => $banner->title,
                'description' => $banner->description,
                'image' => $banner->image,
            ]
        ];

        return $data;
    }
}