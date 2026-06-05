<?php

namespace App\Transformers\Models;

class ModelResponse {
    public static function format ($model) {
        $data = [
            'model' => [
                'id' => $model->id,
                'full_name' => $model->full_name,
                'image' => $model->image,
            ]
        ];

        return $data;
    }
}