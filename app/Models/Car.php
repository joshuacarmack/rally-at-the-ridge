<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name','last_name','address','city','state','zip','phone','email',
        'vehicle_type','year','make','model','color',
        'previously_attended','tshirt_size','home_church',
        'checked_in','checked_in_at','checked_in_by',
        'tshirt_given','comments','party_size',
        'is_last_year_winner','is_test','prize_drawn','prize_claimed',
        'submission_token',
    ];

    protected $casts = [
        'previously_attended' => 'bool',
        'checked_in'          => 'bool',
        'checked_in_at'       => 'datetime',
        'tshirt_given'        => 'bool',
        'party_size'          => 'integer',
        'is_last_year_winner' => 'bool',
        'is_test'             => 'bool',
        'prize_drawn'         => 'bool',
        'prize_claimed'       => 'bool',
        'year'                => 'integer',
    ];
}
