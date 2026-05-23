<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectVideo extends Model
{
    use HasFactory;

    protected $table = 'project_videos';
    protected $fillable = [
        'project_id',
        'video'
    ];
}
