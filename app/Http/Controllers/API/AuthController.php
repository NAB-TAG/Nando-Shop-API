<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(  )
    {
        
    }
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
        $csrf_token = csrf_token();
        return response()->json([
            'message' => 'Seras redireccionado Ahora mismo',
            'auth_token' => $token,
            'csrf_token' => $csrf_token
        ])->withCookie(Cookie::make('auth_token',$token, 60, null,null,null,true,false,'None'))
        ->withCookie(Cookie::make('csrf_token',$csrf_token, 60, null,null,null,true,false,'None'));
        
    }
    


    public function user(Request $request){
        // $user = auth('sanctum')->user();
        $cookie = $request->cookies();
        return $cookie;
    }
}
