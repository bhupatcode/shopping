<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Products;


class Order extends Model
{
    use HasFactory;

    // Table name if different from the default (plural form of the model name)
    protected $table = 'orders';

    // Define the fillable attributes to allow mass assignment
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'status',
    ];

    // Define relationships with other models (User, Product)

    // An order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An order belongs to a product
    // public function product()
    // {
    //     return $this->belongsTo(Products::class);
    // }
    public function calculateTotalPrice()
    {
        return $this->quantity * $this->product->price;
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function product()
    {
        return $this->belongsTo(Products::class); // Adjust to your Product model name
    }
     public function as()
    {
        return $this->quantity;
    }
}
