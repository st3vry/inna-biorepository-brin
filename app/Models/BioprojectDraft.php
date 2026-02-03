<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioprojectDraft extends Model
{
    use HasFactory;

    protected $table = 'bioproject_drafts';

    protected $fillable = [
        'user_id',
        'title',
        'data',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
