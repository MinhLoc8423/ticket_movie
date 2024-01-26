<?php
 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class Ticket extends Model
{
    public $table = 'ticket';
    protected $primaryKey = 'ticketID';
    public $timestamps = false;
    protected $fillable = ['movie_id', 'price', 'show_time_id', 'cinema_id', 'seat_id', 'role'];
    protected $hidden = [
        'is_disabled'
    ];
}