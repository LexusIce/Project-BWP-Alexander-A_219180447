<?php

namespace App\Rules;

use App\Models\users;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class username implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $bool = true;
        $data = users::get();
        foreach ($data as $key) {
            if($value == $key->Username){
                $fail('Username Sudah Terdaftar');
            }
        }

    }
}
