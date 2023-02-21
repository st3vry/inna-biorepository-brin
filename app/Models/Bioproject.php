<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bioproject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'published_at'];


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

    public function grant()
    {
        return $this->hasMany(Grant::class);
    }

    public function datatype()
    {
        return $this->hasMany(Datatype::class);
    }

    public function consortium()
    {
        return $this->belongsTo(Consortium::class);
    }

    public function externallink()
    {
        return $this->hasMany(BioProjectExternalLink::class);
    }

    public function getRouteKeyName()
    {
        return 'accession';
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('title', 'like', '%' . $search . '%')
            ->orWhere('submission', 'like', '%' . $search . '%')
            ->orWhere('accession', 'like', '%' . $search . '%');
    }
}
