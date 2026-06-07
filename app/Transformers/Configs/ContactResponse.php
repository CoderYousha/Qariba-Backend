<?php

namespace App\Transformers\Configs;

class ContactResponse {
    public static function format ($facebook, $youtube, $tiktok, $instagram, $email, $whatsapp) {
        $data = [
            'data' => [
                'facebook' => $facebook,
                'youtube' => $youtube,
                'tiktok' => $tiktok,
                'instagram' => $instagram,
                'email' => $email,
                'whatsapp' => $whatsapp,
            ]
        ];

        return $data;
    }
}