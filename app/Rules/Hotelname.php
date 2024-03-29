<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Hotelname implements Rule
{
    private $word;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
       $words= ["free", "offer", "book", "website"];
        foreach ($words as $word) {
            if (strpos(strtolower($value), $word) !== false) {
                $this->word=$word;
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute cannot contain '.$this->word.'.';
    }
}
