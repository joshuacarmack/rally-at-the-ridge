<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drawing extends Model
{
    protected $fillable = ['user_id','car_id','claimed'];
    protected $casts = ['claimed' => 'bool'];

    public function car()  { return $this->belongsTo(Car::class); }
    public function user() { return $this->belongsTo(User::class); }
}
