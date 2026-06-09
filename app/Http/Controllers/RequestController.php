<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Request as ModelsRequest;
use App\Services\RequestService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected $requestService;
    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    //Create Request Function
    public function store (OrderRequest $orderRequest){
        return $this->requestService->createRequest($orderRequest->all());
    }

    //Update Request Function
    public function update (ModelsRequest $request, OrderRequest $orderRequest){
        return $this->requestService->updateRequest($request, $orderRequest->all());
    }

    //Delete Request Function
    public function destroy (ModelsRequest $request){
        return $this->requestService->deleteRequest($request);
    }

    //Change Request Status Function
    public function changeStatus (ModelsRequest $modelRequest, Request $request){
        return $this->requestService->changeStatus($modelRequest, $request->status);
    }

    //Get Requests Function
    public function view (Request $request){
        return $this->requestService->getRequests($request->search);
    }

    //Get Request Function
    public function show (ModelsRequest $request){
        return $this->requestService->getRequest($request);
    }
}
