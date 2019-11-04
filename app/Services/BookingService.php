<?php
namespace App\Services;

use App\Accommodation;

class BookingService
{
    public function changeAvailability(Accommodation $accommodation)
    {
        if( $accommodation->availability==0)
            return false;
        $accommodation->availability -= 1;
        $accommodation->save();
        return true;
    }
}
