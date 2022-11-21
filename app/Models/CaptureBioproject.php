<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptureBioproject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bioproject()
    {
        return $this->belongsTo(Bioproject::class);
    }

    public function capture()
    {
        return $this->belongsTo(Capture::class);
    }
}
