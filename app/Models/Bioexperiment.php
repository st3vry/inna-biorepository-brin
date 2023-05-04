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
    public function biosample()
    {
        return $this->belongsTo(Biosample::class);
    }
    public function libsource()
    {
        return $this->belongsTo(LibrarySource::class);
    }
    public function libselection()
    {
        return $this->belongsTo(LibrarySelection::class);
    }
    public function libstrategy()
    {
        return $this->belongsTo(LibraryStrategy::class);
    }
    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }
    public function liblayout()
    {
        return $this->belongsTo(LibraryLayout::class);
    }


}
