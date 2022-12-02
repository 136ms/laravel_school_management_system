<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subject extends Model
{
    use HasFactory;
    public $table = 'subjects';

    public $fillable = [
        'subject_name'
    ];

    protected $casts = [
        'subject_name' => 'string'
    ];

    public static $rules = [
        'subject_name' => 'required|string|max:255'
    ];


}
