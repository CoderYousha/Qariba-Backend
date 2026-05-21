<?php

namespace App\Services;

use App\Models\Config;
use App\Transformers\Configs\AboutusResponse;

class AboutusService {
    public function setAboutus ($content){
        $aboutus = Config::where('key', 'about_us')->first();

        if($aboutus){
            $aboutus->update ([
                'content' => $content
            ]);
        }else{
            $aboutus = Config::create([
                'key' => 'about_us',
                'content' => $content,
            ]);
        }

        return success(AboutusResponse::format($aboutus), 'تم ضبط قسم معلومات حولنا');
    }

    public function getAboutus (){
        $aboutus = Config::where('key', 'about_us')->first();

        return success(AboutusResponse::format($aboutus), 'معلومات حولنا');
    }
}