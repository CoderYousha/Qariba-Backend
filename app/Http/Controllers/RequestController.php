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

    //Get Requests Function
    public function view (){
        return $this->requestService->getRequests();
    }

    //Get Request Function
    public function show (ModelsRequest $request){
        return $this->requestService->getRequest($request);
    }
}
