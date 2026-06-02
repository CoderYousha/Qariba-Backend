<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $with = ['user', 'sub_category'];
    protected $table = 'requests';
    protected $fillable = [
        'user_id',
        'sub_category_id',
        'description',
    ];

    public function sub_category (){
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function user (){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
