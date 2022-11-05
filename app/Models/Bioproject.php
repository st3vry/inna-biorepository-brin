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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function samplescope()
    {
        return $this->belongsTo(Samplescope::class);
    }

    public function publication()
    {
        return $this->hasMany(Publication::class);
    }

    public function getRouteKeyName()
    {
        return 'alias';
    }
}
