<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiosampleDraft extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'biosample_id', 'title', 'data', 'status'];

    protected $casts = [
        'data' => 'array',
        'status' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function biosample()
    {
        return $this->belongsTo(Biosample::class);
    }
}
