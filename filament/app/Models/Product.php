<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'image_url', 'price', 'currency_id', 'provider_id', 'status_id', 'stock', 'category_id'
    ];

    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
