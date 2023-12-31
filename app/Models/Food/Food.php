<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table="foods";

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'subcategory_id',
        'description',
        'image',
    ];

     public $timestamps=true;

     public function category()
     {
         return $this->belongsTo(Category::class);
     }

     public function subcategory()
     {
         return $this->belongsTo(Subcatgory::class);
     }


    
}
