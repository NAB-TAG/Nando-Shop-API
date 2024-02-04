<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToAuth(): JsonResponse
    {
        return response()->json([
            'url' => Socialite::driver('google')
                         ->stateless()
                         ->redirect()
                         ->getTargetUrl(),
        ]);
    }

    public function handleAuthCallback(): JsonResponse
    {
        try {
            /** @var SocialiteUser $socialiteUser */
            $socialiteUser = Socialite::driver('google')->stateless()->user();
        } catch (ClientException $e) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }
        /** @var User $user */
        $user = User::query()
            ->firstOrCreate(
                [
                    'email' => $socialiteUser->getEmail(),
                ],
                [
                    'email_verified_at' => now(),
                    'name' => $socialiteUser->getName(),
                    'google_id' => $socialiteUser->id,
                    'avatar' => $socialiteUser->getAvatar(),
                ]
            );
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'user' => $user,
            'token_type' => 'Bearer',
        ])->withCookie(cookie('access_token', $token, 60, null, null, true, true));
    }
    public function verificarCookie(Request $request)
    {
        // Verificar si la cookie está presente en la solicitud
        if ($request->hasCookie('access_token')) {
            // La cookie existe
            return response()->json(['mensaje' => 'La cookie existe']);
        } else {
            // La cookie no existe
            return response()->json(['mensaje' => 'La cookie no existe']);
        }
    }
}
