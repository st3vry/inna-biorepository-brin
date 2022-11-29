<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publication extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function bioproject()
    {
        return $this->BelongsTo(Bioproject::class);
    }

    public function pubIdentifier()
    {
        return $this->belongsTo(PubIdentifier::class);
    }
}
