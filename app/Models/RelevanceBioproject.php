<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelevanceBioproject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bioproject()
    {
        return $this->hasMany(Bioproject::class);
    }

    public function Relevance()
    {
        return $this->hasMany(Relevance::class);
    }
}
