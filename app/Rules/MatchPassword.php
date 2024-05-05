<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class MatchPassword implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value === request()->input('password');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute and password must match.';
    }
}
