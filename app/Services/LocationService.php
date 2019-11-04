<?php
namespace App\Services;

use App\Location;

class LocationService
{
    public function storeLocation(array $location)
    {
        return Location::create($location);
    }
}
