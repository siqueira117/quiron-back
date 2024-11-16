<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UrlPattern implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Verifica se valor tem simbolos ou numeros
        if (preg_match('/[^a-zA-Z0-9_-]/', $value) > 0) {
            $fail('The :attribute must be valid string.');
        }
    }
}
