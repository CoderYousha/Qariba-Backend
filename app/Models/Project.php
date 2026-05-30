<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $with = ['images', 'videos', 'category'];
    protected $table = 'projects';
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'clinet_name',
        'project_url',
        'cover_image',
    ];

    public function category () {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images (){
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }

    public function videos (){
        return $this->hasMany(ProjectVideo::class, 'project_id', 'id');
    }
}
