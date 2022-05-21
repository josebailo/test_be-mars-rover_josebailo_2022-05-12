<?php

namespace App\Rules;

use App\Services\ParseInstructionsService;
use Illuminate\Contracts\Validation\Rule;

class Instructions implements Rule
{
    private string $errorMessage;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            ParseInstructionsService::validate($value);
            return true;
        } catch (\Throwable $th) {
            $this->errorMessage = $th->getMessage();
            return false;
        }
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
