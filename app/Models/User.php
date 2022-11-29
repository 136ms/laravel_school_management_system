<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    public $table = 'users';

    public $fillable = [
        'fname',
        'lname',
        'birthdate',
        'adress',
        'email',
        'gender',
        'phonenum',
        'password'
    ];

    protected $casts = [
        'fname' => 'string',
        'lname' => 'string',
        'birthdate' => 'date',
        'adress' => 'string',
        'email' => 'string',
        'gender' => 'string',
        'phonenum' => 'string',
        'password' => 'string'
    ];

    public static $rules = [
        'id' => 'required',
        'fname' => 'required|string|max:255',
        'lname' => 'required|string|max:255',
        'birthdate' => 'required|date',
        'adress' => 'required|string|max:255',
        'email' => 'required',
        'gender' => 'required|string|max:255',
        'phonenum' => 'required|string|max:255',
        'password' => 'required'
    ];


}
