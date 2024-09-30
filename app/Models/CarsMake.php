<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsMake extends Model
{
    use HasFactory;

    protected $table = 'cars_make';

    protected $fillable = ['name'];
}
