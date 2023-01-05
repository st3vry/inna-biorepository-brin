<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectiveBioProject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function bioproject()
    {
        return $this->belongsTo(Bioproject::class);
    }
    public function objecive()
    {
        return $this->belongsTo(Objective::class);
    }
}
