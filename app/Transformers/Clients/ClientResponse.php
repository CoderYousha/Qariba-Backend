<?php

namespace App\Transformers\Clients;

class ClientResponse {
    public static function format ($client) {
        $data = [
            'data' => [
                'id' => $client->id,
                'image' => $client->image,
            ]
        ];

        return $data;
    }
}