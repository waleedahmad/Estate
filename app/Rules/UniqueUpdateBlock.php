<?php

namespace App\Rules;

use App\Blocks;
use Illuminate\Contracts\Validation\Rule;

class UniqueUpdateBlock implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($town_id, $block_id)
    {
        $this->town_id = $town_id;
        $this->block_id = $block_id;
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
        return !$this->blockExist($this->town_id, $value, $this->block_id);
    }

    public function blockExist($town_id, $block, $block_id){
        return Blocks::where('town_id', '=', $town_id)->where('name', '=', $block)->where('id', '!=', $block_id)->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Block already exist';
    }
}
