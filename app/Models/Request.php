<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $with = ['user', 'category'];
    protected $table = 'requests';
    protected $fillable = [
        'user_id',
        'category_id',
        'description',
    ];

    public function category (){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user (){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
