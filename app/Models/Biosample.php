<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biosample extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'published_at'];
    protected $casts = ['organism_detail' => 'array'];

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

    public function bioproject()
    {
        return $this->belongsTo(Bioproject::class);
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

    // Relationship to the submitter (user)
    public function submitter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to the curator (user)
    public function curator()
    {
        return $this->belongsTo(User::class, 'curator_id');
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'biosample_id');
    }
}
