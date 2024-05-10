<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';

    protected $fillable = ['user_id', 'product_name', 'order_date'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ordered_items', 'order_id', 'product_id')
                    ->withTimestamps();
    }

    /**
     * Define the relationship in the Order model to represent the user who placed the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
