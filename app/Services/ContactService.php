<?php

namespace App\Services;

use App\Models\Config;
use App\Transformers\Configs\ContactResponse;

class ContactService
{
    public function setContact($facebook, $tiktok, $instagram, $youtube)
    {
        $_facebook = Config::where('key', 'facebook')->first();
        $_tiktok = Config::where('key', 'tiktok')->first();
        $_instagram = Config::where('key', 'instagram')->first();
        $_youtube = Config::where('key', 'youtube')->first();

        $_facebook->update([
            'content' => $facebook
        ]);
        $_tiktok->update([
            'content' => $tiktok
        ]);
        $_instagram->update([
            'content' => $instagram
        ]);
        $_youtube->update([
            'content' => $youtube
        ]);

        return success(ContactResponse::format($_facebook->content, $_youtube->content, $_tiktok->content, $_instagram->content), 'تم ضبط جهات الاتصال');
    }

    public function getContacts()
    {
        $_facebook = Config::where('key', 'facebook')->first();
        $_tiktok = Config::where('key', 'tiktok')->first();
        $_instagram = Config::where('key', 'instagram')->first();
        $_youtube = Config::where('key', 'youtube')->first();

        return success(ContactResponse::format($_facebook->content, $_youtube->content, $_tiktok->content, $_instagram->content), 'تم ضبط جهات الاتصال');
    }
}
