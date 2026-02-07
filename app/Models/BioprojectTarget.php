<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BioprojectTarget extends Model
{
    use HasFactory;

    protected $table = 'bio_project_targets';

    protected $fillable = [
        'bioproject_id',
        'organism_novel',
        'organism_novel_description',
        'organism_sbc',
        'organism_isolate',
        'organism_desc',
        'celularity_id',
        'reproduction_id',
        'ploidy_id',
        'ploidy_description',
        'haploid_genome_size',
        'genome_size_id',
        'phenotypes_disease',
        'biotic_relationship_id',
        'trophic_level_id',
        'prokaryote_morphology_gram',
        'prokaryote_morphology_motility',
        'prokaryote_morphology_enveloped',
        'prokaryote_morphology_endospores',
        'habitat_id',
        'salinity_id',
        'oxygen_req_id',
        'temp_range_id',
        'optimum_temp',
    ];

    protected $casts = [
        'bioproject_id' => 'integer',
        'celularity_id' => 'integer',
        'reproduction_id' => 'integer',
        'ploidy_id' => 'integer',
        'genome_size_id' => 'integer',
        'biotic_relationship_id' => 'integer',
        'trophic_level_id' => 'integer',
        'habitat_id' => 'integer',
        'salinity_id' => 'integer',
        'oxygen_req_id' => 'integer',
        'temp_range_id' => 'integer',
    ];

    public function bioproject(): BelongsTo
    {
        return $this->belongsTo(Bioproject::class);
    }

    public function celularity(): BelongsTo
    {
        return $this->belongsTo(Celularity::class);
    }

    public function reproduction(): BelongsTo
    {
        return $this->belongsTo(Reproduction::class);
    }

    public function ploidy(): BelongsTo
    {
        return $this->belongsTo(Ploidy::class);
    }

    public function genomeSize(): BelongsTo
    {
        return $this->belongsTo(GenomeSize::class);
    }

    public function bioticRelationship(): BelongsTo
    {
        return $this->belongsTo(BioticRelationship::class);
    }

    public function trophicLevel(): BelongsTo
    {
        return $this->belongsTo(TrophicLevel::class);
    }

    public function habitat(): BelongsTo
    {
        return $this->belongsTo(Habitat::class);
    }

    public function salinity(): BelongsTo
    {
        return $this->belongsTo(Salinity::class);
    }

    public function oxygenReq(): BelongsTo
    {
        return $this->belongsTo(OxygenReq::class);
    }

    public function tempRange(): BelongsTo
    {
        return $this->belongsTo(TempRange::class);
    }
}
