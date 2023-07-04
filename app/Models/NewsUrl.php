<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsUrl extends Model
{
    use HasFactory;

    protected $table = 'NewsUrl';

    protected $fillable = ['image_url','news_id'];
}
