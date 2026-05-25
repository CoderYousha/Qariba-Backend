<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    protected $bannerService;
    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    //Create Banner Function
    public function store(BannerRequest $bannerRequest)
    {
        return $this->bannerService->createBanner($bannerRequest->all());
    }

    //Update Banner Function
    public function update(Banner $banner, BannerRequest $bannerRequest)
    {
        $rules = $bannerRequest->rules();

        unset($rules['image']);

        Validator::make(
            $bannerRequest->all(),
            $rules
        )->validate();

        return $this->bannerService->updateBanner($banner, $bannerRequest->all());
    }
    
    //Delete Banner Function
    public function destroy (Banner $banner){
        return $this->bannerService->deleteBanner($banner);
    }

    //Get All Banners Function
    public function view (){
        return $this->bannerService->getBanners();
    }

    //Get Banner Function
    public function show (Banner $banner){
        return $this->bannerService->getBanner($banner);
    }
}
