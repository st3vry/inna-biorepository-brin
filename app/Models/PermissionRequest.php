<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PermissionRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'permission_type',
        'request_reason',
        'temporary_url',
        'is_agreed',
        'expires_at',
    ];

    protected $dates = [
        'expires_at',  // Tell Laravel this is a date field
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically set the `expires_at` to 5 days from `created_at`
        static::creating(function ($permissionRequest) {
            $permissionRequest->expires_at = Carbon::now()->addDays(5);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
