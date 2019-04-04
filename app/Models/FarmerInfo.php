<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FarmerInfo extends Model
{
    protected $table = 'farmer_info';

    protected $fillable = [
        'user_id',
        'surname',
        'first_name',
        'middle_name',
        'nickname',
        'sex',
        'date_of_birth',
        'id_type',
        'id_number',
        'town_village_settlement',
        'road_street_trace_address',
        'house_number',
        'email',
        'postal_office_box',
        'postal_town_village_settlement',
        'postal_street_road_trace_sentence',
        'district_province',
        'region',
        'country',
        'is_absentee_farmer',
        'date_verified',
        'photograph_url',
        'applicant_signage_url'
    ];

    protected $guarded = [
        'is_verified',
    ];

    /**
     * Fetches related farmer enterprises
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enterprises(): HasMany
    {
        return $this->hasMany(FarmerEnterprise::class);
    }

    /**
     * Fetches all lands that belongs to this farmer
     * @return HasMany
     */
    public function lands(): HasMany
    {
        return $this->hasMany(Land::class);
    }

    /**
     * Fetches the farmers bank information
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bankInfo(): HasOne
    {
        return $this->hasOne(BankInfo::class);
    }

}
