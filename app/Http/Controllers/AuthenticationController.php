<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    protected $authenticationService;
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    //Login Function
    public function login (LoginRequest $loginRequest){
        return $this->authenticationService->login($loginRequest->email, $loginRequest->password);
    }

    //Profile Function
    public function profile (){
        return $this->authenticationService->profile();
    }

    //Update Password Function
    public function updatePassword (UpdatePasswordRequest $updatePasswordRequest){
        return $this->authenticationService->updatePassword($updatePasswordRequest);
    }

    //Logout Function
    public function logout (){
        return $this->authenticationService->logout();
    }
    
    //Update Profile Function
    public function updateProfile (UpdateProfileRequest $updateProfileRequest){
        return $this->authenticationService->updateProfile($updateProfileRequest->all());
    }
}
