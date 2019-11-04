<?php
namespace App\Services;

use App\Accommodation;

class FilterService
{
    public function filter($query,$data)
    {
        if(isset($data['rating']) && $data['rating']!=null)
            $query->filterRating($data['rating']);

        if(isset($data['city']) && $data['city']!=null)
            $query->filterCity($data['city']);

        if(isset($data['reputationBadge']) && $data['reputationBadge']!=null)
            $query->filterReputationBadge($data['reputationBadge']);

        if(isset($data['more_availability']) && $data['more_availability']!=null)
            $query->filterMoreAvailability($data['more_availability']);

        if(isset($data['less_availability']) && $data['less_availability']!=null)
            $query->filterLessAvailability($data['less_availability']);

        if(isset($data['category']) && $data['category']!=null)
            $query->filterCategory($data['category']);

        return $query;
    }
}
