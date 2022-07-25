<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table ='categories';

    protected $fillable = [
        'languages_abbe',
        'translation_of',
        'name',
        'slug',
        'description',
        'populer',
        'status',
        'img',
        'meta_title',
        'meta_descrip',
        'meta_kewwords',
        'store_id',
        'sub_cat_of',
    ];
    public function Products()
    {
        return $this->hasMany(Product::class,'cat_id');

    }
    public function store( )
    {
       return $this->belongsTo(Store::class,'store_id','id');
    }


    public function scopeArCat($query)
    {
        return $query->where('languages_abbe','ar');
    }


}
