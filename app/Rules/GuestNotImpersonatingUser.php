<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GuestNotImpersonatingUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if email belongs to a registered user
        $user = User::where('email', $value)->first();

        if ($user) {
            // Email is registered - check if user is logged in with this email
            if (! auth()->check() || auth()->user()->email !== $value) {
                $fail('Et voi käyttää tätä sähköpostiosoitetta.');
            }
        }
    }
}
