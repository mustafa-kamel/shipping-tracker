<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'number'];

    public function shippings()
    {
        return $this->hasMany(App\Models\Shipping::class);
    }
}
