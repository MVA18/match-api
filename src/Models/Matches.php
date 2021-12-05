<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';

    protected $fillable = ['user_id', 'profile_id', 'pref'];

    public $timestamps = false;
}