<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Category extends Model
{
    use HasFactory;

    // Table name (optional if it follows the convention of plural form)
    protected $table = 'categories';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'image',
        'slug',
        'description'
    ];

    // Relationship: A category can have many products
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
