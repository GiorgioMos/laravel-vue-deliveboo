<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'date',
        'notes',
        'guest_name',
        'guest_surname',
        'guest_telephone',
        'guest_email',
        'guest_address',
        'guest_city'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
