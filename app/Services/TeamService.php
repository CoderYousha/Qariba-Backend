<?php

namespace App\Services;

use App\Models\Team;
use App\Transformers\Team\MemberResponse;
use App\Transformers\Team\MembersResponse;
use Illuminate\Support\Facades\File;

class TeamService
{
    public function addMember($data)
    {
        if ($data['image']) {
            $data['image'] = uploadImage($data['image'], 'TeamImages');
        }

        $member = Team::create($data);

        return success(MemberResponse::format($member), 'تم إضافة عضو جديد', 201);
    }

    public function updateMember(Team $member, $data)
    {
        if (isset($data['image'])) {
            if (File::exists($member->image)) {
                File::delete($member->image);
            }

            $data['image'] = uploadImage($data['image'], 'TeamImages');
        }

        $member->update($data);

        return success(MemberResponse::format($member), 'تم تحديث بيانات العضو');
    }

    public function deleteMember(Team $member)
    {
        if (File::exists($member->image)) {
            File::delete($member->image);
        }

        $member->delete();

        return success(null, 'تم حذف هذا العضو بنجاح');
    }

    public function getMembers ($search){
        $members = Team::where('full_name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->get();

        return success(MembersResponse::format($members), 'عرض جميع أعضاء الفريق');
    }

    public function getMember (Team $member){
        return success(MemberResponse::format($member), 'عرض تفاصيل العضور');
    }
}
