<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Help extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_message',
        'admin_message'
    ]; 
    
    public function users()
    {
       return $this->belongsTo(User::class,'id');
    }
}
