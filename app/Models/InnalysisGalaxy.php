<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class InnalysisGalaxy extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];
    protected $connection = 'mongodb';
    protected $collection = 'running_job';
    // protected $dates = ['created_at', 'updated_at'];
}
