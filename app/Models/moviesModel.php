<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class moviesModel extends Model
{
    use SoftDeletes;


    protected $table = 'movies';
    protected $primaryKey = 'movieID';
    public $timestamps = false;
    protected $fillable = ['movie_title', 'description', 'thumnail', 'genre_id', 'movie_time'];
    protected $dates = ['deleted_at'];
}
