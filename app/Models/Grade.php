<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public $table = 'users';

    public $fillable = [
        'name',
        'weight',
        'grade',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'name' => 'string',
        'weight' => 'string',
        'grade' => 'date',
        'created_at' => 'string',
        'updated_at' => 'string',
    ];

    public static $rules = [
        'name' => 'required|string|max:50',
        'weight' => 'required|double',
        'grade' => 'required|float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
