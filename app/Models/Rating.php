<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_service_id',
        'provider_id',
        'user_id',
        'rating',
        'text',
        'status'
    ];


    public function users()
    {
        return $this->belongsTo(\App\Models\User::class,'user_id');
    }

    public function scopeActive()
    {
        return $this->where('status','1');
    }


}
