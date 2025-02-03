<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules; // Asegúrate de que este trait esté en app/Actions/Fortify/PasswordValidationRules.php

    /**
     * Valida y resetea la contraseña olvidada del usuario.
     *
     * @param  \App\Models\User  $user
     * @param  array  $input
     * @return void
     */
    public function reset(User $user, array $input): void
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
