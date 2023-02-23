<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'main_category_id',
        'sub_category_id',
        // 'author_id',
        'title',
        'formate',
        'formate_id',
        'image',
        'isbn',
        'isbn10',
        'isbn13',
        'language',
        'edition',
        'publisher',
        'author',
        'date_published',
        'condition',
        'quantity',
        // 'width',
        // 'height',
        // 'length',
        // 'weight',
        'dimensions',
        'pages',
        'price',
        'status',
        'popular',
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


    public function admins()
    {
        return $this->belongsTo(\App\Models\Admin::class,'admin_id');
    }

    public function mainCategories()
    {
        return $this->belongsTo(\App\Models\MainCategory::class,'main_category_id');
    }

    public function subCategories()
    {
        return $this->belongsTo(\App\Models\SubCategory::class,'sub_category_id')->withDefault();
    }

    public function parentBook()
    {
        return $this->belongsTo(\App\Models\ManageBook::class,'parent_id')->withDefault();
    }

    public function authors()
    {
        return $this->belongsTo(\App\Models\Author::class,'author_id');
    }


}
