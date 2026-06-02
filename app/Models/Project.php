<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $with = ['images', 'videos', 'sub_category'];
    protected $table = 'projects';
    protected $fillable = [
        'sub_category_id',
        'title',
        'description',
        'client_name',
        'project_url',
        'cover_image',
    ];

    public function sub_category () {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function images (){
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }

    public function videos (){
        return $this->hasMany(ProjectVideo::class, 'project_id', 'id');
    }
}
