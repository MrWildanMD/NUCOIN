<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Donator extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'donators';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];
}
