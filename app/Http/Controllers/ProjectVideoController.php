<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectVideo;
use App\Services\ProjectVideoService;
use Illuminate\Http\Request;

class ProjectVideoController extends Controller
{
    protected $projectVideoService;
    public function __construct(ProjectVideoService $projectVideoService)
    {
        $this->projectVideoService = $projectVideoService;
    }

    //Add Video Function
    public function store(Project $project, Request $request)
    {
        return $this->projectVideoService->addVideo($project, $request->all());
    }

    //Delete Video Function
    public function destroy(ProjectVideo $projectVideo)
    {
        return $this->projectVideoService->deleteVideo($projectVideo);
    }
}
