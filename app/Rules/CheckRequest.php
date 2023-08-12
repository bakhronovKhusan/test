<?php

namespace App\Rules;

use App\Models\Products;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Rule;

class CheckRequest implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->errorMessage = "Not Found";
        if(Products::where('code',explode('.', $attribute)[1])->first()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }
}
