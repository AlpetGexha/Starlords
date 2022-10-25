<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Instagram implements Rule
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
        return preg_match('#https?\://(?:www\.)?instagram\.com/(\d+|[A-Za-z0-9\.]+)/?#', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is not a valid Instagram URL (https://www.instagram.com/USERNAME).';
    }
}
