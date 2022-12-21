<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioProjectExternalLink extends Model
{
    use HasFactory;
    protected $guarded = ['id']; //selain ID di input dari manual (sistem)

    public function bioproject()
    {
        return $this->BelongsTo(Bioproject::class);
    }
}

