<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'index',
        'name',
        'price',
        'description',
        'category_id',
        'image',
        'isActive',
        'min_req_qty',
        'manufacturing_partner_id',
        'supplier_id',
        'unit_id',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function allergens()
    {
        return $this->belongsToMany(Allergen::class);
    }
    public function inventory()
    {
        return $this->hasOne(Product::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Retrive only Active record
    public function scopeIsActive($query)
    {
        return $query->where('IsActive', 1);
    }
}
