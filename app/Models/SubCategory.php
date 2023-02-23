<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MainCategory;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'main_category_id',
        'sub_category_name',
        'status',
        'premium',
    ];

    public function Mcategory()
    {
        return $this->belongsTo(MainCategory::class);
    }
    
    public function scopeActive($q)
    {
        return $q->where('status',1);
    }
}
