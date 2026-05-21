<?php

namespace App\Transformers\Configs;

class ContactResponse {
    public static function format ($facebook, $youtube, $tiktok, $instagram) {
        $data = [
            'data' => [
                'facebook' => $facebook,
                'youtube' => $youtube,
                'tiktok' => $tiktok,
                'instagram' => $instagram,
            ]
        ];

        return $data;
    }
}