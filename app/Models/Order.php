<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table ='orders';
    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
        'total_price',
        'status',
        'message',
        'tracking_no',
        'payment_mode',
        'payment_id',
        'store_id',
    ];

    public function OrderItems ()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function store ()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
