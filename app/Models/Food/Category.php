<?php

namespace App\Models\Food;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table="category";

    protected $fillable = [
        
        'name',
        
    ];
    public $timestamps=true;

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
   
}
