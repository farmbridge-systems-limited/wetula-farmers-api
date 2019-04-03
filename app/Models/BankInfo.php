<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{

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
}
