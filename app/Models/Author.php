<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
    ];

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status']=$value=='Active' ? '1' : '0';
    }

    public function getStatusAttribute()
    {
       return $this->attributes['status']=='1' ? 'Active' : 'Inactive';
    }

    public function manageBooks()
    {
        return $this->hasMany(\App\Models\Admin\manageBooks::class);
    }
    
}
