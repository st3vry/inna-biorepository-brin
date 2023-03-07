<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biorun extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function bioexperiment()
    {
        return $this->belongsTo(Bioexperiment::class);
    }
}
