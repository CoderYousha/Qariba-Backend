<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModelRequest;
use App\Models\Modell;
use App\Services\ModelService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModelController extends Controller
{
    protected $modelService;
    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    //Add Model Function
    public function store(ModelRequest $modelRequest)
    {
        return $this->modelService->addModel($modelRequest->all());
    }

    //Update Model Function
    public function update(Modell $model, Request $request)
    {
        $modelRequest = new ModelRequest();
        $rules = $modelRequest->rules();
        $messages = method_exists($modelRequest, 'messages') ? $modelRequest->messages() : [];

        unset($rules['image']);

        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );

        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 422)
            );
        }

        return $this->modelService->updateModel($model, $request->all());
    }

    //Delete Model Function
    public function destroy (Modell $model){
        return $this->modelService->deleteModel($model);
    }

    //Get Models Function
    public function view (Request $request){
        return $this->modelService->getModels($request->search);
    }

    //Get Model Function
    public function show (Modell $model){
        return $this->modelService->getModel($model);
    }
}
