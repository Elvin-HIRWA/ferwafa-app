<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUrl extends Model
{
    use HasFactory;

    protected $table = 'EventUrl';

    protected $fillable = ['image_url', 'event_id'];
}
