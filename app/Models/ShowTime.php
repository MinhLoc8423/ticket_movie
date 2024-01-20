<?php
 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class ShowTime extends Model
{
    protected $table = 'showtime';
    protected $primaryKey = 'showtimeID';
    protected $fillable = ['movie_id1123123', 'cinema_id', 'time'];
}