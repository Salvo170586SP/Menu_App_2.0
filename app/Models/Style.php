<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $fillable = ['url_logo','color_item','font_size','font_size_cat', 'color_accordion', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
