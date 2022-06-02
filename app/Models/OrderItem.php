
<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table ='order_items';
    protected $fillable = [
        'order_id',
        'prod_id',
        'prod_qty',
        'price',
    ];

    public function pruduct()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
