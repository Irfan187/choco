<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'mobilenumber',
        'address',
        'fax_number',
        'isActive'
    ];
    public function scopeIsActive($query)
    {
        return $query->where('IsActive', 1);
    }
}
