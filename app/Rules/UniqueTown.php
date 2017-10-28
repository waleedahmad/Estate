<?php

namespace App\Rules;

use App\Towns;
use Illuminate\Contracts\Validation\Rule;

class UniqueTown implements Rule
{
    private $city_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($city_id)
    {
        $this->city_id = $city_id;
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
        return !$this->townExist($this->city_id, $value);
    }

    public function townExist($city_id, $town){
        return Towns::where('city_id', '=', $city_id)->where('name', '=', $town)->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Town already exist.';
    }
}
