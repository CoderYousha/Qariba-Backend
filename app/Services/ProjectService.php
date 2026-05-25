<?php

namespace App\Services;

use App\Models\Project;
use App\Transformers\Projects\ProjectsResponse;
use App\Transformers\Projects\ProjectResponse;
use Illuminate\Support\Facades\File;

class ProjectService
{
    public function createProject($data)
    {
        if ($data['cover_image']) {
            $data['cover_image'] = uploadImage($data['cover_image'], 'ProjectsCovers');
        }

        $project = Project::create($data);

        return success(ProjectResponse::format($project), 'تم إضافة المشروع بنجاح', 201);
    }

    public function updateProject(Project $project, $data)
    {
        if ($data['cover_image']) {
            if (File::exists($project->cover_image)) {
                File::delete($project->cover_image);
            }
            $data['cover_image'] = uploadImage($data['cover_image'], 'ProjectsCovers');
        }

        $project->update($data);

        return success(ProjectResponse::format($project), 'تم تعديل المشروع بنجاح');
    }

    public function deleteProject(Project $project)
    {
        if (File::exists($project->cover_image)) {
            File::delete($project->cover_image);
        }

        foreach ($project->images as $image) {
            if (File::exists($image->image)) {
                File::delete($image->image);
            }
        }

        foreach ($project->videos as $video) {
            if (File::exists($video->video)) {
                File::delete($video->video);
            }
        }

        $project->delete();

        return success(null, 'تم حذف المشروع بنجاح');
    }

    public function getProjects()
    {
        $projects = Project::paginate(10);

        return success(ProjectsResponse::format($projects), 'المشاريع');
    }

    public function getProject(Project $project)
    {
        return success(ProjectResponse::format($project), 'تفاصيل المشروع');
    }
}
