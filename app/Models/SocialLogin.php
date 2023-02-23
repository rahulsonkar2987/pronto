<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'key',
        'client_id',
        'client_secret_id',
        'status',
    ];
}
