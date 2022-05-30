<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class messegeLength implements Rule
{
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
        $length=strlen($value);
        return $length > 100 ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'messege must be greater than 100 charcter';
    }
}
