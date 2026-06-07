<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    //Set Contacts Function
    public function setContacts (Request $request){
        return $this->contactService->setContact($request->facebook, $request->tiktok, $request->instagram, $request->youtube, $request->email, $request->whatsapp);
    }

    //Get Contacts Function
    public function show (){
        return $this->contactService->getContacts();
    }

    //Send Email Function
    public function sendEmail (SendEmailRequest $sendEmailRequest){
        return $this->contactService->sendEmail($sendEmailRequest->all());
    }
}
