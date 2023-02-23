<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class MainCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'main_category_name',
        'status',
    ];

    public function Scategory()
    {
        return $this->hasMany(SubCategory::class);
    } 

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }
    
}
