<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Sha1 implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Verifica se valor tem simbolos ou numeros
        $result = (bool)preg_match('/^[0-9a-f]{40}$/i', $value);
        if (!$result) {
            $fail('The :attribute must be valid sha1.');
        }
    }
}
