<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_eng',
        'description',
        'description_eng',
        'manufacturer',
        'price',
        'price_goblet',
        'price_bottle',
        'quantity_cl',
        'quantity_lt',
        'url_img',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
