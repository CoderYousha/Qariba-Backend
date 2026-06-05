<?php

namespace App\Services;

use App\Models\Modell;
use App\Transformers\Models\ModelResponse;
use App\Transformers\Models\ModelsResponse;
use Illuminate\Support\Facades\File;

class ModelService
{
    public function addModel($data)
    {
        if ($data['image']) {
            $data['image'] = uploadImage($data['image'], 'ModelsImages');
        }

        $model = Modell::create($data);

        return success(ModelResponse::format($model), 'تم إضافة العارضة بنجاح', 201);
    }

    public function updateModel(Modell $model, $data)
    {
        if (isset($data['image'])) {
            if (File::exists($model->image)) {
                File::delete($model->image);
            }

            $data['image'] = uploadImage($data['image'], 'ModelsImages');
        }

        $model->update($data);

        return success(ModelResponse::format($model), 'تم تعديل العارضة بنجاح');
    }

    public function deleteModel(Modell $model)
    {
        if (File::exists($model->image)) {
            File::delete($model->image);
        }

        $model->delete();

        return success(null, 'تم حذف العارضة بنجاح');
    }

    public function getModels ($search){
        $models = Modell::where('full_name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->get();

        return success(ModelsResponse::format($models), 'عرض العارضات');
    }

    public function getModel (Modell $model){
        return success(ModelResponse::format($model), 'عرض تفاصيل العارضة');
    }
}
