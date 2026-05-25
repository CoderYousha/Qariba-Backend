<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\File;

class ProjectImageService
{
    public function addImage(Project $project, $data)
    {
        $data['project_id'] = $project->id;
        if ($data['image']) {
            $data['image'] = uploadImage($data['image'], 'ProjectsImages');

            $projectImage = ProjectImage::create($data);

            return success($projectImage, 'تم إضافة الصورة بنجاح', 201);
        }
    }

    public function updateImage(ProjectImage $projectImage, $data)
    {
        if ($data['image']) {
            if (File::exists($projectImage->image)) {
                File::delete($projectImage->image);
            }
            $data['image'] = uploadImage($data['image'], 'ProjectsImages');

            $projectImage->update($data);

            return success($projectImage, 'تم إضافة الصورة بنجاح');
        }
    }

    public function deleteImage(ProjectImage $projectImage)
    {
        if (File::exists($projectImage->image)) {
            File::delete($projectImage->image);
        }

        return success(null, 'تم حذف الصورة بنجاح');
    }
}
