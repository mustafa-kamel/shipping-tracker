<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'shipment_number', 'status'];

    public function courier()
    {
        return $this->belongsTo(App\Models\Courier::class);
    }

    public function products()
    {
        return $this->belongsToMany(App\Models\Product::class);
    }
}
