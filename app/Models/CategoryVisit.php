<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVisit extends Model
{
    use HasFactory;
    protected $table ='category_visits';

    protected $fillable = [
        'cat_id',
        'user_id',
    ];
}
