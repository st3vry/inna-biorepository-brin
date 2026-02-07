<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioarchiveDraft extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','bioarchive_id','title','data','status'];
    protected $casts = [
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
