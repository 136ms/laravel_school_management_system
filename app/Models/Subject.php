<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;
    public $table = 'subjects';

    public $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'string'
    ];

    public static $rules = [
        'name' => 'required|string|max:255'
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }
}
