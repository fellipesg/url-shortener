<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShortener extends Model
{
    use HasFactory;

    protected $table = "url_shortener";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['short_url', 'long_rl'];
}
