<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'product_image',
        'product_desc',
        'price',
        'stock_quantity'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'ordered_items', 'product_id', 'order_id')
                    ->withTimestamps();
    }
}
