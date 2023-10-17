<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class DistinctCharacteristic implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!collect($value)
            ->map(fn (array $characteristic) => Arr::only($characteristic, ['address', 'ip']))  
            ->duplicates()->isEmpty())
        {
            $fail('Адрес и ip не могут совпадать в двух характеристиках');
        }
    }
}
