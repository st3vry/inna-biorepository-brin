<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function target()
    {
        return $this->belongsTo(User::class, 'user_target');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
