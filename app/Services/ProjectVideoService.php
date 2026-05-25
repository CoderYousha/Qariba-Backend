<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectVideo;
use Illuminate\Support\Facades\File;

class ProjectVideoService
{
    public function addVideo(Project $project, $data)
    {
        $data['project_id'] = $project->id;
        if ($data['video']) {
            $data['video'] = uploadImage($data['video'], 'ProjectsVideos');

            $projectVideo = ProjectVideo::create($data);

            return success($projectVideo, 'تم إضافة الفيديو بنجاح', 201);
        }
    }

    public function deleteVideo(ProjectVideo $projectVideo)
    {
        if (File::exists($projectVideo->video)) {
            File::delete($projectVideo->video);
        }

        return success(null, 'تم حذف الفيديو بنجاح');
    }
}
