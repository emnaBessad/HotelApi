<?php

namespace App\Http\Requests;

use App\Rules\Hotelname;
use Illuminate\Foundation\Http\FormRequest;

class AccommodationUpdateRequest extends FormRequest
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
        $nameValidations=['nullable','string'];
        //append the custom rule for hotelName

        if($this->category!=null && $this->category=='hotel')
        {
            $nameValidations[]=new Hotelname;
            $nameValidations[]='min:10';
        }

        return
            [
                'name'=>$nameValidations,
                'rating'=> ['nullable','integer','min:0','max:5'],
                'category' => ['nullable','string','in:hotel,alternative,hostel,lodge,resort,guest-house'],
                'city'=>['nullable','string'],
                'state'=>['nullable','string'],
                'country'=>['nullable','string'],
                'zip_code'=>['nullable','integer','digits:5'],
                'address'=>['nullable','string'],
                'image'=> ['nullable','url'],
                'reputation' => ['nullable','integer','min:0','max:1000'],
                'price'=>['nullable','integer'],
                'availability'=>['nullable','integer'],
            ];
    }
}
