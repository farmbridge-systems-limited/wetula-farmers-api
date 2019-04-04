<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankInfo extends Model
{
    protected $table = 'bank_info';

    protected $fillable = [
        'farmer_info_id',
        'account_type',
        'account_name',
        'bic_swift_code',
        'bank_name',
        'branch_name',
        'branch_address',
        'bank_phone_number',
    ];

    protected $guarded = [
        'account_number'
    ];

    /**
     * fetches the farmer who owns this bankInformation
     * @return BelongsTo
     */
    public function farmer(): BelongsTo
    {
        return $this->belongsTo(FarmerInfo::class);
    }
}
