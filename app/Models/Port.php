<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    protected $fillable = [
        'name',
        'code',
        'latitude',
        'longitude',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
