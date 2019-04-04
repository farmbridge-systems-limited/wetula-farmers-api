<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Land extends Model
{

    protected $fillable = [
        'farmer_info_id',
        'verification_officer_id',
        'address',
        'size_area',
        'gps_address',
        'region',
        'district',
        'locality',
        'applicable_tenure_codes',
        'remarks'
    ];

    protected $guarded = [
        'is_tenureship_verified',
        'are_documents_verified'
    ];

    /**
     * Fetches the land owner record @see FarmerInfo
     * @return BelongsTo
     */
    public function farmer(): BelongsTo
    {
        return $this->belongsTo(FarmerInfo::class);
    }

    /**
     * Fetches all documents for this land
     * @return HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(LandDocument::class);
    }

}
