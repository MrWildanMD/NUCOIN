<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Coins extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'coins';
    protected $primaryKey = 'id';

    protected $fillable = [
        'amount',
        'coin_date',
        'proof',
        'user_id',
        'donator_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function donators()
    {
        return $this->belongsTo(Donator::class, 'donator_id');
    }
}
