<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_category', 'name_category_eng', 'user_id', 'position', 'url_img'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //   //FUNZIONA
    //   public static function boot()
    //   {
    //       parent::boot();
    //       //FUNZIONA
    //       static::creating(function ($category) {
    //           $lastPosition = Category::max('position');
    //           $category->position = $lastPosition + 1;
    //           Category::where('position', '>=', $category->position)->increment('position');
    //       });

    //       //FUNZIONA
    //       static::deleted(function ($category) {
    //           $category->updatePositionsOnDelete();
    //       });
    //   }

    //   //FUNZIONA
    //   public function updatePositionsOnDelete()
    //   {
    //       $deletedPosition = $this->position;
    //       Category::where('position', '>', $deletedPosition)
    //           ->orderBy('position')
    //           ->decrement('position');
    //   }


    protected static function boot()
    {
        parent::boot();

        // Aggiungi qui le tue personalizzazioni per il metodo boot
        static::creating(function ($category) {
            if ($category->position  === null) {
                // quando aggiunge una categoria aggiorna la posizione assegnando la posizione di 1
                $maxPosition = self::max('position');
                $category->position = $maxPosition + 1;
            } 
        });

        static::deleting(function ($category) {
            // quando elimina una categoria controlla se la posizione è maggiore di quella esistente e la decrementa 
            self::where('position', '>', $category->position)->decrement('position');
        });
    }
}
