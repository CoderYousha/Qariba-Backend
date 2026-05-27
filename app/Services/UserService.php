<?php

namespace App\Services;

use App\Models\User;
use App\Transformers\Users\UserResponse;
use App\Transformers\Users\UsersResponse;
use Illuminate\Support\Facades\File;

class UserService
{
    public function getUsers($search)
    {
        $users = User::where('role', 'client')->where(function ($query) use ($search) {
            $query->where('full_name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')->orWhere('phone', 'LIKE', '%' . $search . '%');
        })->orderBy('created_at', 'asc')->paginate(10);

        return success(UsersResponse::format($users), 'عرض الزبائن');
    }

    public  function getUser(User $user)
    {
        return success(UserResponse::format($user), 'تفاصيل حساب الزبون');
    }

    public function deleteUser(User $user)
    {
        if (File::exists($user->image)) {
            File::delete($user->image);
        }

        $user->delete();

        return success(null, 'تم حذف الزبون بنجاح');
    }
}
