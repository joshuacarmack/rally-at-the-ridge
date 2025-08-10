<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['car_id','added_by'];
    public function car()  { return $this->belongsTo(Car::class); }
    public function user() { return $this->belongsTo(User::class, 'added_by'); }
}
