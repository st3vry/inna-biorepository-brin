<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bp_externalLinks extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function bioproject()
    {
        return $this->BelongsTo(Bioproject::class);
    }
}
