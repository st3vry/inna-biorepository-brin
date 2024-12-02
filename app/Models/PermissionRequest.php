<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PermissionRequest extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'user_id',
    //     'request_reason',
    //     'temporary_url',
    //     'is_agreed',
    //     'expires_at',
    // ];
    protected $fillable = [
        'user_id',
        'bioarchive_id',
        'bioarchive_accession',
        'reason',
        'research_area',
        'research_title',
        'abstract',
        'proof_of_funding',
        'letter_of_agreement',
        'research_proposal',
        'cv',
        'is_agreed',
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
