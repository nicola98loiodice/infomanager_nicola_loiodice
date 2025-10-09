<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'minutes',
        'shift_type',
        'is_signed',
    ];

    // relazione con l’utente
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
