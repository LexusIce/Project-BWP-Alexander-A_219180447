<?php

namespace App\Rules;

use App\Models\users;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class email implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $data = users::get();
        foreach ($data as $key) {
            if($value == $key->Email){
                $fail('Email Sudah Terdaftar');
            }
        }
    }
}
