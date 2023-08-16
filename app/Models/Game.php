<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'Game';

    protected $fillable = ['homeTeamID', 'awayTeamID', 'seasonID', 'dayID', 'stadeID', 'date', 'startTime'];
}