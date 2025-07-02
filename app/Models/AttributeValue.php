<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function biosample()
    {
        return $this->belongsTo(Biosample::class);
    }

    public function sampletype()
    {
        return $this->belongsTo(Sampletype::class);
    }

    public function attributesample()
    {
        return $this->belongsTo(Attributesample::class);
    }

    public function sampletypeFAIR()
    {
        return $this->belongsTo(SampleType::class, 'sampletype_id');
    }

    public function attributesampleFAIR()
    {
        return $this->belongsTo(AttributeSample::class, 'attributesample_id');
    }
}
