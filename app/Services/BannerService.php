<?php

namespace App\Services;

use App\Models\Banner;
use App\Transformers\Banners\BannerResponse;
use App\Transformers\Banners\BannersResponse;
use Illuminate\Support\Facades\File;

class BannerService
{
    public function createBanner($data)
    {
        if ($data['image']) {
            $data['image'] = uploadImage($data['image'], 'BannersImages');
        }
        $banner = Banner::create($data);

        return success(BannerResponse::format($banner), 'تم إنشاء الإعلان بنجاح', 201);
    }

    public function updateBanner(Banner $banner, $data)
    {
        if ($data['image']) {
            if (File::exists($banner->image)) {
                File::delete($banner->image);
            }
            $data['image'] = uploadImage($data['image'], 'BannersImages');
        }

        $banner->update($data);

        return success(BannerResponse::format($banner), 'تم تعديل الإعلان بنجاح');
    }

    public function deleteBanner(Banner $banner)
    {
        if (File::exists($banner->image)) {
            File::delete($banner->image);
        }
        $banner->delete();

        return success(null, 'تم حذف الإعلان بنجاح');
    }

    public function getBanners()
    {
        $banners = Banner::orderBy('created_at', 'desc')->paginate(10);

        return success(BannersResponse::format($banners), 'عرض الإعلانات');
    }

    public function getBanner(Banner $banner)
    {
        return success(BannerResponse::format($banner), 'عرض تفاصيل الإعلان');
    }
}
