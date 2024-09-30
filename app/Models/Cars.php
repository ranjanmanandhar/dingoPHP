<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'state_id',
        'vin',
        'year',
        'colour',
        'make_id',
        'model_id'
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo(Models::class, 'model_id', 'id');
    }

    public function make()
    {
        return $this->belongsTo(CarsMake::class, 'make_id', 'id');
    }

    public function quote()
    {
        return $this->hasMany(Quote::class, 'car_id', 'id');
    }
}
