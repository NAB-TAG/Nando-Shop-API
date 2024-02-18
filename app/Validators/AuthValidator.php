<?php

namespace App\Validators;

use App\Contracts\AuthValidatorInterface;
use Illuminate\Contracts\Validation\Validator;


class AuthValidator implements AuthValidatorInterface
{
    public function validate(array $data): Validator
    {
        $rules = [
            'email' => ['required']
        ];

        $messages = [
            'email.required' => 'El email es requerido'
        ];

        // Accedemos a la fachada de Validator
        return \Validator::make($data, $rules, $messages);
    }

    // public function validateLogin(array $data): Validator
    // {
    //     $rules = [
    //         'email' => ['required'],
    //         'password' => ['required'],
    //     ];

    //     $messages = [
    //         'email.required' => 'The email is required to log in. please enter a email to continue.',
    //         'password.required' => 'The password is required to log in, please enter a name to continue.',
    //     ];

    //     // Accedemos a la clase Validator en el espacio de nombres global, no es Illuminate\Contracts\Validation\Validator
    //     return \Validator::make($data, $rules, $messages);
    // }
}