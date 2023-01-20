<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    use HasFactory;

    public $table = 'grades';

    public $fillable = [
        'name',
        'grade',
        'weight',
        'user_id',
    ];

    public static $rules = [
        'name' => 'required|string|max:50',
        'grade' => 'required|integer',
        'weight' => 'required|float',
    ];

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function subject() : BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
