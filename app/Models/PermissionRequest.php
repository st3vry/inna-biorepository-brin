<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
        'is_approved',
        'temporary_url',
        'temporary_url_expiration',
    ];

    // public function generateTemporaryUrl($filePath, $expiration = 3600)
    // {
    //     return Storage::disk('public')->temporaryUrl($filePath, now()->addSeconds($expiration));
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
