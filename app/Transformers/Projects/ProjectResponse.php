<?php

namespace App\Transformers\Projects;

class ProjectResponse
{
    public static function format($project)
    {
        $data = [
            'project' => [
                'id' => $project->id,
                'title' => $project->title,
                'description' => $project->description,
                'client_name' => $project->client_name,
                'project_url' => $project->project_url,
                'cover_image' => $project->cover_image,
                'images' => $project->images,
                'videos' => $project->videos,
                'sub_category' => $project->sub_category,
                'category' => $project->sub_category->category,
            ]
        ];

        return $data;
    }
}
