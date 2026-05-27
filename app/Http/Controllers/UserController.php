<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    //Get Users Function
    public function view (Request $request){
        return $this->userService->getUsers($request->search);
    }

    //Get User Function
    public function show (User $user){
        return $this->userService->getUser($user);
    }

    //Delete User Function
    public function destroy (User $user){
        return $this->userService->deleteUser($user);
    }
}
