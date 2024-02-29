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

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity'); //aggiunto per collegare terzo campo ai primi due, spero sia giusto
    }
}
