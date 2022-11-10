<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributesample extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
}
