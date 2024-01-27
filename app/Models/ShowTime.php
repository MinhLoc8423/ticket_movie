<?php
 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class ShowTime extends Model
{
    protected $table = 'showtime';
    protected $primaryKey = 'showtimeID';
    public $timestamps = false;
    protected $fillable = ['movie_id', 'cinema_id', 'time'];
}