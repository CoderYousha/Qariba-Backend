<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $with = ['subCategories'];
    protected $table = 'categories';
    protected $fillable = [
        'service',
        'category',
    ];

    public function subCategories (){
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
}
