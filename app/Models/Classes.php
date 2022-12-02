<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    public $table = 'classes';

    public $fillable = [
        'class_name'
    ];

    protected $casts = [
        'class_name' => 'string'
    ];

    public static $rules = [
        'class_name' => 'required|string|max:255'
    ];


}
