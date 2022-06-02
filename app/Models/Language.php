<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = [

        'abbe',
        'name',
        'locale',
        'direction',
        'active',

    ];

    public function scopeActive($query) {

        return $query->where('active',1);

    }
}
