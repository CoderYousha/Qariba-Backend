<?php

namespace App\Services;

use App\Mail\ContactSendEmail;
use App\Models\Config;
use App\Transformers\Configs\ContactResponse;
use Exception;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    public function setContact($facebook, $tiktok, $instagram, $youtube, $email, $whatsapp)
    {
        $_facebook = Config::where('key', 'facebook')->first();
        $_tiktok = Config::where('key', 'tiktok')->first();
        $_instagram = Config::where('key', 'instagram')->first();
        $_youtube = Config::where('key', 'youtube')->first();
        $_email = Config::where('key', 'email')->first();
        $_whatsapp = Config::where('key', 'whatsapp')->first();

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
        $_email->update([
            'content' => $email
        ]);
        $_whatsapp->update([
            'content' => $whatsapp
        ]);

        return success(ContactResponse::format($_facebook->content, $_youtube->content, $_tiktok->content, $_instagram->content, $_email->content, $_whatsapp->content), 'تم ضبط جهات الاتصال');
    }

    public function getContacts()
    {
        $_facebook = Config::where('key', 'facebook')->first();
        $_tiktok = Config::where('key', 'tiktok')->first();
        $_instagram = Config::where('key', 'instagram')->first();
        $_youtube = Config::where('key', 'youtube')->first();
        $_email = Config::where('key', 'email')->first();
        $_whatsapp = Config::where('key', 'whatsapp')->first();

        return success(ContactResponse::format($_facebook->content, $_youtube->content, $_tiktok->content, $_instagram->content, $_email->content, $_whatsapp->content), 'تم ضبط جهات الاتصال');
    }

    public function sendEmail ($data){
        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactSendEmail($data));

            return success(null, 'تم إرسال الرسالة بنجاح');
        }catch(Exception $e){
            return error('some thing went wrong', 'تعذر إرسال الرسالة');
        }
    }
}
