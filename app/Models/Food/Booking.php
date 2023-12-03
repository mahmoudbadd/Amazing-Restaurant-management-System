<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $table="booking";

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'date',
        'num_people',
        'req',
        'status',
    ];

     public $timestamps=true;
}
