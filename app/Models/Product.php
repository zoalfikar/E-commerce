<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='prodects';

    protected $fillable =[
        'cat_id',
        'name',
        'slug',
        'small_description',
        'description',
        'orginal_price',
        'selling_price',
        'img',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_descrip',
        'meta_kewwords',
    ];

    public function Category ( ) {

        return $this->belongsTo(Category::class,'cat_id','id');

    }
}
