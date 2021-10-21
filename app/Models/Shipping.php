<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'shipment_number', 'status', 'address', 'courier_id'];

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }
}
