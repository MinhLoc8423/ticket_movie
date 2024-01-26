<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
class BookingHistory extends Model 
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    public $table = 'booking';
    public $timestamps = false;
    protected $fillable = [
        'ticket_id',
        'booking_time',
        'ticket_quantity',
        'user_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */

}
