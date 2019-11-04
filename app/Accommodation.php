<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'rating', 'category', 'location_id', 'image', 'reputation', 'price', 'availability',
    ];
    protected $hidden=['location_id'];

    protected $appends=['reputationBadge'];

    /**
     * The reputation badge is a calculated value that depends on the reputation
     */
    public function getReputationBadgeAttribute()
    {
        if(!isset($this->reputation) || $this->reputation==null) return null;
        if($this->reputation<=500)
            return 'red';
        if($this->reputation<=799)
            return 'yellow';
        return 'green';
    }

    /**
     * Get  location of accomodations
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Scope a query to only include accomodations of a given rating.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $rating
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope a query to only include accomodations of a given rating.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $rating
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterCity($query, $city)
    {
        return $query->whereHas('location', function (Builder $query) use ($city) {
            $query->where('city', '=', $city);
        });
    }

    /**
     * Scope a query to only include accomodations of a given reputationBadge.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $reputationBadge
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterReputationBadge($query, $reputationBadge)
    {
        if($reputationBadge=='red')
            return $query->whereBetween('reputation', [0,500]);
        if($reputationBadge=='yellow')
            return $query->whereBetween('reputation', [501,799]);
        return $query->whereBetween('reputation', [800,1000]);
    }

    /**
     * Scope a query to only include accomodations of a given availability.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $availability
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterMoreAvailability($query, $availability)
    {
        return $query->where('availability', '>',$availability);
    }

    /**
     * Scope a query to only include accomodations of a given availability.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $availability
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterLessAvailability($query, $availability)
    {
        return $query->where('availability', '<',$availability);
    }

    /**
     * Scope a query to only include accomodations of a given category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $categoryv
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterCategory($query, $category)
    {
        return $query->where('category', $category);
    }

}
