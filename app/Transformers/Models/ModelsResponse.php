<?php

namespace App\Transformers\Models;

class ModelsResponse
{
    public static function format($models)
    {
        $data = ['models' => []];

        foreach ($models as $model){
            $data['models'][] = [
                'id' => $model->id,
                'full_name' => $model->full_name,
                'image' => $model->image,
            ];
        }

        return $data;
    }
}
