<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datatype extends Model
{
    use HasFactory;

    public function bioproject()
    {
        return $this->BelongsToMany(Bioproject::class);
    }
}
