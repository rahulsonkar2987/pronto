<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'key',
        'value',
        'status',
    ];

    public function scopeGeneral($query,$key)
    {
        return $query->where('key',$key)->first()->id;
    }
}
