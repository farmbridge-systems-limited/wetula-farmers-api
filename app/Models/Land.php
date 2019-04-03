<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
