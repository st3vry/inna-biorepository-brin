<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatatypeBioproject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function bioproject()
    {
        return $this->belongsTo(Bioproject::class);
    }
    public function datatype()
    {
        return $this->belongsTo(Datatype::class);
    }
}
