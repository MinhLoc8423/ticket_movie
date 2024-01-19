<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class BookingHistory extends Model 
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    public $table = 'ticket';
    public $timestamps = false;
    protected $fillable = [
        'movie_id',
        'price',
        'show_time_id',
        'cinema_id',
        'user_id',
        'seat_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
}
