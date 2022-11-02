<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bioproject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function organism()
    {
        return $this->belongsTo(Organism::class);
    }

    public function getRouteKeyName()
    {
        return 'alias';
    }

    public function publication()
    {
        return $this->belongsToMany(Publication::class);
    }
}
