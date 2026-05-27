<?php

namespace App\Transformers\Users;

use App\Transformers\Pagination\PaginationResponse;
use Illuminate\Support\Facades\Auth;

class UsersResponse
{
    public static function format($users)
    {
        $data = ['users' => []];

        foreach ($users as $user) {
            $data['users'][] = [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'phone' => $user->phone,
                'email' => $user->email,
                'image' => $user->image,
            ];
        }

        $data['pagination'] = PaginationResponse::format($users);

        return $data;
    }
}
