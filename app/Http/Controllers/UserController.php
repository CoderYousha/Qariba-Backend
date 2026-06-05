<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPasswordRequest;
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
    public function view(Request $request)
    {
        return $this->userService->getUsers($request->search);
    }

    //Get User Function
    public function show(User $user)
    {
        return $this->userService->getUser($user);
    }

    //Update User Function
    public function update(User $user, UpdateUserPasswordRequest $updateUserPasswordRequest) {
        return $this->userService->updatePassword($user, $updateUserPasswordRequest->new_password);
    }

    //Delete User Function
    public function destroy(User $user)
    {
        return $this->userService->deleteUser($user);
    }

    //Export Users List as PDF
    public function export (){
        return $this->userService->exportPdf();
    }
}
