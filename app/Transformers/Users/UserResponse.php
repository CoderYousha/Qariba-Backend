<?php

namespace App\Transformers\Users;

class UserResponse
{
    public static function format($user)
    {
        $data = [
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'phone' => $user->phone,
                'email' => $user->email,
                'image' => $user->image,
            ]
        ];

        return $data;
    }
}
