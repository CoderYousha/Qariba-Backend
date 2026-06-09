<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $with = ['user', 'subCategory', 'Category', 'model'];
    protected $table = 'requests';
    protected $fillable = [
        'user_id',
        'service',
        'category_id',
        'sub_category_id',
        'category',
        'sub_category',
        'description',
        'status',
    ];

    public function Category (){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory (){
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function user (){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function model (){
        return $this->belongsTo(Modell::class, 'model_id', 'id');
    }
}
