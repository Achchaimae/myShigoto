<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;
    protected $fillable = [
        'FirstName',
        'LastName',
        'email',
        'phone',
        'address',
        'cv',
        'status',
    ];
    //relate apply with post apply
    public function postApply()
    {
        return $this->hasMany(PostApply::class);
    }
}
