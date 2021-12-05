<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password','gender', 'age', 'token', 'token_expire'];

    public $timestamps = false;

    public function validateToken($token)
    {
        return $this->token == $token;
    }

    public function getByToken($token)
    {
        return $this->where('token','=',$token)->first();
    }

    public function keepTokenAlive()
    {
        $this->token_expire = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $this->save();
    }
}