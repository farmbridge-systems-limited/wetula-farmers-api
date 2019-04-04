<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandDocument extends Model
{

    protected $fillable = [
        'land_id',
        'document_type',
        'document_url',
    ];


    /**
     * Fetches the related farmer land
     * @return BelongsTo
     */
    public function land(): BelongsTo
    {
        return $this->belongsTo(Land::class);
    }

}
