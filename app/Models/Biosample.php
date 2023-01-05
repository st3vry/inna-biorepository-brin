<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biosample extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'published_at'];

    public function organism()
    {
        return $this->belongsTo(Organism::class);
    }
    public function sampletype()
    {
        return $this->belongsTo(Sampletype::class);
    }
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function externallink()
    {
        return $this->hasMany(BioSampleExternalLink::class);
    }

    public function getRouteKeyName()
    {
        return 'accession';
    }
}
