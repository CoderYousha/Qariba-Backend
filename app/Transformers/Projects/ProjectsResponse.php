<?php

namespace App\Transformers\Projects;

use App\Transformers\Pagination\PaginationResponse;
use Illuminate\Support\Facades\Auth;

class ProjectsResponse
{
    public static function format($projects)
    {
        $data = ['projects' => []];

        foreach ($projects as $project) {
            $data['projects'][] = [
                'id' => $project->id,
                'title' => $project->title,
                'description' => $project->description,
                'client_name' => $project->client_name,
                'project_url' => $project->project_url,
                'cover_image' => $project->cover_image,
                'images' => $project->images,
                'videos' => $project->videos,
                'category' => $project->category,
            ];
        }

        $data['pagination'] = PaginationResponse::format($projects);

        return $data;
    }
}
