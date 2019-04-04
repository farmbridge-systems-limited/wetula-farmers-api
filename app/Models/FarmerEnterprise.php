<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmerEnterprise extends Model
{

    protected $fillable = [
        'farmer_info_id',
        'enterprise_id',
        'engagement_status'
    ];

    /**
     * Gets the @see FarmerInfo record to whom this @see FarmerEnterprise belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farmer(): BelongsTo
    {
        return $this->belongsTo(FarmerInfo::class);
    }

}
