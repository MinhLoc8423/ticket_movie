<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'userID';
    public $timestamps = false;
    protected $fillable = ['name','phone','pass_word','image_url','email','api_token'];
}
