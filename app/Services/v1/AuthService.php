<?php

namespace App\Services\v1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthService
{
    public function store( array $data )
    {
        $user = new User();
        $user->name = 'guest_'.Str::random(10);
        $user->email = $data[ "email" ];
        $user->password = Hash::make($data[ "password" ]);

        if ( $user->save() ) {
            return response()->json(["success", "Operacion Exitosa", "El usuario fue creado con exito."], 201);
        } else {
            return response()->json(["error", "El usuario no se pudo registrar", "Hubo un error en el servidor, comunicate con el administrador."], 500);
        }
    }
}