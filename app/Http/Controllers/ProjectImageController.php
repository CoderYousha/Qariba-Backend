<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectImageRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Services\ProjectImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectImageController extends Controller
{
    protected $projectImageService;
    public function __construct(ProjectImageService $projectImageService)
    {
        $this->projectImageService = $projectImageService;
    }

    //Add Image Function
    public function store(Project $project, ProjectImageRequest $projectImageRequest)
    {
        return $this->projectImageService->addImage($project, $projectImageRequest->all());
    }

    //Update Image Function
    public function update(ProjectImage $projectImage, ProjectImageRequest $projectImageRequest)
    {
        $rules = $projectImageRequest->rules();

        unset($rules['image']);

        Validator::make(
            $projectImageRequest->all(),
            $rules
        )->validate();

        return $this->projectImageService->updateImage($projectImage, $projectImageRequest->all());
    }

    //Delete Image Function
    public function destroy (ProjectImage $projectImage){
        return $this->projectImageService->deleteImage($projectImage);
    }
}
