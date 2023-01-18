<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public $table = 'grades';

    public $fillable = [
        'name',
        'grade',
        'weight',
    ];

    public static $rules = [
        'name' => 'required|string|max:50',
        'grade' => 'required|integer',
        'weight' => 'required|float',
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
