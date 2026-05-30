<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Exceptions\HttpResponseException;
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
    public function update(Project $project, Request $request)
    {
        $projectRequest = new ProjectRequest();
        $rules = $projectRequest->rules();
        $messages = method_exists($projectRequest, 'messages') ? $projectRequest->messages() : [];

        unset($rules['cover_image']);

        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );

        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 422)
            );
        }
        return $this->projectService->updateProject($project, $request->all());
    }

    //Delete Project Function
    public function destroy(Project $project)
    {
        return $this->projectService->deleteProject($project);
    }

    //Get Projects Function
    public function view(Request $request)
    {
        return $this->projectService->getProjects($request->search);
    }

    //Get Project Function
    public function show(Project $project)
    {
        return $this->projectService->getProject($project);
    }
}
