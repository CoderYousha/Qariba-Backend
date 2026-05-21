<?php

namespace App\Transformers\Configs;

class AboutusResponse {
    public static function format ($aboutus) {
        $data = [
            'data' => [
                'id' => $aboutus->id,
                'aboutus' => $aboutus->content,
            ]
        ];

        return $data;
    }
}