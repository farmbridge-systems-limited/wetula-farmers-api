<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerEnterprise extends Model
{

    protected $fillable = [
        'farmer_info_id',
        'enterprise_id',
        'engagement_status'
    ];

}
