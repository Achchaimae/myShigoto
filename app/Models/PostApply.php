<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostApply extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'apply_id',
    ];
    protected $table = 'post_applies' ;
    //relate post with post apply
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    //relate apply with post apply
    public function apply()
    {
        return $this->belongsTo(Apply::class);
    }
  

}
