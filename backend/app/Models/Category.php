<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'description'
    ];

    public function restaurant()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}
