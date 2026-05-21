<?php

namespace App\Http\Controllers;

use App\Services\AboutusService;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    protected $aboutusService;
    public function __construct(AboutusService $aboutusService)
    {
        $this->aboutusService = $aboutusService;
    }

    //Set Aboutus Function
    public function setAboutus (Request $request){
        return $this->aboutusService->setAboutus($request->content);
    }

    //Get Aboutus Function
    public function show (){
        return $this->aboutusService->getAboutus();
    }
}
