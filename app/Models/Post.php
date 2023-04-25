<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'title',
        'description',
        'tag',
        'city',
        'type_of_post',
        'user_id'
    ];
    //relate post with post apply
    public function postApply()
    {
        return $this->hasMany(PostApply::class);
    }
    public function User(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
