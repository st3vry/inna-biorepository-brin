<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bioexperiment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function biorun()
    {
        return $this->hasMany(Biorun::class);
    }
}
