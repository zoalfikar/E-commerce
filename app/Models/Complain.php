<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $table = 'complains';

    protected $fillable = [
        'user_id',
        'prod_id',
        'complain',
    ];

    public function product ()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }

    public function user ()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
