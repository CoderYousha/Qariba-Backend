<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Exceptions\HttpResponseException;
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
        $bannerRequest->validate([
            'image' => 'required|image'
        ], [
            'image.required' => 'الصورة مطلوبة',
            'image.image' => 'الصورة غير صالحة',
        ]);
        return $this->bannerService->createBanner($bannerRequest->all());
    }

    //Update Banner Function
    public function update(Banner $banner, Request $request)
    {
        $bannerRequest = new BannerRequest();
        $rules = $bannerRequest->rules();
        $messages = method_exists($bannerRequest, 'messages') ? $bannerRequest->messages() : [];

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

        return $this->bannerService->updateBanner($banner, $request->all());
    }

    //Delete Banner Function
    public function destroy(Banner $banner)
    {
        return $this->bannerService->deleteBanner($banner);
    }

    //Get All Banners Function
    public function view(Request $request)
    {
        return $this->bannerService->getBanners($request->search);
    }

    //Get Banner Function
    public function show(Banner $banner)
    {
        return $this->bannerService->getBanner($banner);
    }
}
