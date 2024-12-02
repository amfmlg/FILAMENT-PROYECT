<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
