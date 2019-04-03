<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandDocument extends Model
{

    protected $fillable = [
        'land_id',
        'document_type',
        'document_url',
    ];

}
