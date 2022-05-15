<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Instructions implements Rule
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
        $instructionsList = explode("\n", $value);

        return $this->hasMinimumOfInstructions($instructionsList) &&
            $this->hasAmountOfInstructions($instructionsList);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The instructions are not valid.';
    }

    /**
     * Has at least the plateau coordinates
     * and one rover's instructions.
     */
    private function hasMinimumOfInstructions($value): bool
    {
        return count($value) >= 3;
    }

    /**
     * The number of instructions is odd always,
     * one for the plateau coordinates and two for each rover.
     */
    private function hasAmountOfInstructions($value): bool
    {
        return count($value) % 2 !== 0;
    }
}
