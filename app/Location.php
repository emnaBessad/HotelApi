<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city','state','zip_code','address','country'
    ];

    /**
     * Get  accomodation for location
     */
    public function accomodation()
    {
        return $this->hasOne('App\Accomodations');
    }
}
