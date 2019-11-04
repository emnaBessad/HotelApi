<?php

namespace App\Http\Requests;

use App\Rules\Hotelname;
use Illuminate\Foundation\Http\FormRequest;

class AccommodationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $nameValidations=['required','string'];
        //append the custom rule for hotelName

        if($this->category!=null && $this->category=='hotel')
        {
            $nameValidations[]=new Hotelname;
            $nameValidations[]='min:10';
        }

        return
            [
                'name'=>$nameValidations,
                'rating'=> ['required','integer','min:0','max:5'],
                'category' => ['required','string','in:hotel,alternative,hostel,lodge,resort,guest-house'],
                'city'=>['required','string'],
                'state'=>['required','string'],
                'country'=>['required','string'],
                'zip_code'=>['required','integer','digits:5'],
                'address'=>['required','string'],
                'image'=> ['required','url'],
                'reputation' => ['required','integer','min:0','max:1000'],
                'price'=>['required','integer'],
                'availability'=>['required','integer'],
            ];
    }
}
