<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioSampleExternalLink extends Model
{
    use HasFactory;
    protected $guarded = ['id']; //selain ID di input dari manual (sistem)

    public function biosample()
    {
        return $this->BelongsTo(Biosample::class);
    }
}