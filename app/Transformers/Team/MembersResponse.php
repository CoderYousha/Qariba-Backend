<?php

namespace App\Transformers\Team;

use App\Transformers\Pagination\PaginationResponse;
use Illuminate\Support\Facades\Auth;

class MembersResponse
{
    public static function format($members)
    {
        $data = ['members' => []];

        foreach ($members as $member) {
            $data['members'][] = [
                'id' => $member->id,
                'full_name' => $member->full_name,
                'description' => $member->description,
                'position' => $member->position,
                'image' => $member->image,
            ];
        }

        return $data;
    }
}
