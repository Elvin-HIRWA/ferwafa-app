<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamInSeason extends Model
{
    use HasFactory;

    protected $table = 'TeamInSeason';

    protected $fillable = ['teamID', 'seasonID', 'divisionID'];
}
