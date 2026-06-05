<?php

namespace App\Transformers\Team;

class MemberResponse {
    public static function format ($member) {
        $data = [
            'member' => [
                'id' => $member->id,
                'full_name' => $member->full_name,
                'description' => $member->description,
                'position' => $member->position,
                'image' => $member->image,
            ]
        ];

        return $data;
    }
}