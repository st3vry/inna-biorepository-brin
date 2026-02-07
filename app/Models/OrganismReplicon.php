<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganismReplicon extends Model
{
    use HasFactory;

    protected $table = 'organism_replicons';

    protected $fillable = [
        'bioproject_id',
        'name',
        'repl_type_id',
        'repl_location_id',
        'size',
        'genome_size_id',
    ];

    protected $casts = [
        'bioproject_id' => 'integer',
        'repl_type_id' => 'integer',
        'repl_location_id' => 'integer',
        'genome_size_id' => 'integer',
    ];

    public function bioproject(): BelongsTo
    {
        return $this->belongsTo(Bioproject::class);
    }

    public function replType(): BelongsTo
    {
        return $this->belongsTo(ReplType::class);
    }

    public function replLocation(): BelongsTo
    {
        return $this->belongsTo(ReplLocation::class);
    }

    public function genomeSize(): BelongsTo
    {
        return $this->belongsTo(GenomeSize::class);
    }
}
