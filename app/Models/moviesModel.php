<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class moviesModel extends Model
{
    protected $table = 'movies';
    protected $primaryKey = 'movieID';
    protected $fillable = ['movie_title', 'description', 'thumnail', 'genre_id', 'movie_time'];

}
