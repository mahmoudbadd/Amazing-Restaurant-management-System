<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcatgory extends Model
{
    use HasFactory;

    protected $table="subcategories";

    protected $fillable = [
        'name',
        'category_id',
        
    ];

     public $timestamps=true;

     public function category()
     {
         return $this->belongsTo(Category::class);
     }
     public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
