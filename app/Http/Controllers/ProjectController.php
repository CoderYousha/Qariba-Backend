<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    protected $projectService;
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    //Creaate Project Function
    public function store(ProjectRequest $projectRequest)
    {
        return $this->projectService->createProject($projectRequest->all());
    }

    //Update Project Function
    public function update(Project $project, ProjectRequest $projectRequest)
    {
        $rules = $projectRequest->rules();

        unset($rules['cover_image']);

        Validator::make(
            $projectRequest->all(),
            $rules
        )->validate();

        return $this->projectService->updateProject($project, $projectRequest->all());
    }

    //Delete Project Function
    public function destroy (Project $project){
        return $this->projectService->deleteProject($project);
    }

    //Get Projects Function
    public function view (){
        return $this->projectService->getProjects();
    }

    //Get Project Function
    public function show (Project $project){
        return $this->projectService->getProject($project);
    }
}
