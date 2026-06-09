<?php

namespace App\Services;

use App\Models\Request;
use App\Transformers\Requests\RequestResponse;
use App\Transformers\Requests\RequestsResponse;
use Illuminate\Support\Facades\Auth;

class RequestService {
    public function createRequest ($data){
        $user = Auth::guard('user')->user();
        $data['user_id'] = $user->id;

        $request = Request::create($data);

        return success(RequestResponse::format($request), 'تم إنشاء الطلب بنجاح', 201);
    }

    public function updateRequest (Request $request, $data){
        $request->update($data);

        return success(RequestResponse::format($request), 'تم تعديل الطلب بنجاح');
    }

    public function deleteRequest (Request $request){
        $request->delete();

        return success(null, 'تم حذف الطلب بنجاح');
    }

    public function changeStatus (Request $request, $status){
        $request->update([
            'status' => $status
        ]);

        return success(null, 'تم تعديل حالة الطلب بنجاح');
    }

    public function getRequests ($search){
        $user = Auth::guard('user')->user();
        if($user->role === 'client'){
            $requests = Request::orderBy('created_at', 'desc')->where('user_id', $user->id)->paginate(10);
        }else {
            $requests = Request::orderBy('created_at', 'desc')->where(function ($query) use ($search){
                $query->where('id', 'LIKE', '%' . $search . '%')->orWhereHas('user', function ($user) use ($search){
                    $user->where('full_name', 'LIKE', '%' . $search . '%');
                });
            })->paginate(10);
        }

        return success(RequestsResponse::format($requests), 'الطلبات');
    }

    public function getRequest (Request $request){
        return success(RequestResponse::format($request), 'تفاصيل الطلب');
    }
}