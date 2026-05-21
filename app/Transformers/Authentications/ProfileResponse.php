<?php

namespace App\Transformers\Authentications;

class ProfileResponse {
    public static function format ($user) {
        $data = [
            'data' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $user->role,
                'image' => $user->image,
                'created_at' => $user->created_at,
            ]
        ];

        return $data;
    }
}