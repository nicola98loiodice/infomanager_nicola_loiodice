<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'date',
        'minutes',
        'shift_type',
        'latitude',
        'longitude',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getOreAttribute(): float{
        return round($this->minutes /60,2);
    }
}
