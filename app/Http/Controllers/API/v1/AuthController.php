<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Validators\AuthValidator;
use Illuminate\Http\Request;
// use App\Models\User;
// use GuzzleHttp\Exception\ClientException;
// use Illuminate\Http\JsonResponse;
// use Illuminate\Support\Facades\Cookie;
// use Laravel\Socialite\Facades\Socialite;
// use App\Services\AuthService;
class AuthController extends Controller
{
    private $authValidator;

    public function __construct( AuthValidator $authValidator ){
        $this->authValidator = $authValidator;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Crea un usuario.
     */
    public function store(Request $request)
    {
        $validationResults = $this->authValidator->validate( $request->all() );

        if( $validationResults->fails() ):
            return response()->json(["error", "No te pudiste registrar", $validationResults->errors()->first()], 422);
        endif;

        return ["No hubo problemas en la validacion"];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function redirectToAuth(): JsonResponse
    // {
    //     return response()->json([
    //         'url' => Socialite::driver('google')
    //                      ->stateless()
    //                      ->redirect()
    //                      ->getTargetUrl(),
    //     ]);
    // }


    // public function handleAuthCallback(): JsonResponse
    // {   

    //     try {
    //         /** @var SocialiteUser $socialiteUser */
    //         $socialiteUser = Socialite::driver('google')->stateless()->user();
    //     } catch (ClientException $e) {
    //         return response()->json(['error' => 'Invalid credentials provided.'], 422);
    //     }
    //     /** @var User $user */
    //     $user = User::query()
    //         ->firstOrCreate(
    //             [
    //                 'email' => $socialiteUser->getEmail(),
    //             ],
    //             [
    //                 'email_verified_at' => now(),
    //                 'name' => $socialiteUser->getName(),
    //                 'google_id' => $socialiteUser->id,
    //                 'avatar' => $socialiteUser->getAvatar(),
    //             ]
    //         );
    //     $token = $user->createToken('auth_token')->plainTextToken;
    //     $csrf_token = csrf_token();
    //     return response()->json([
    //         'message' => 'Seras redireccionado Ahora mismo',
    //         'auth_token' => $token,
    //         'csrf_token' => $csrf_token
    //     ])->withCookie(Cookie::make('auth_token',$token, 60, null,null,null,true,false,'None'))
    //     ->withCookie(Cookie::make('csrf_token',$csrf_token, 60, null,null,null,true,false,'None'));
        
    // }
    


    public function user(){
        $user = auth('sanctum')->user();
        
        return $user;
    }

}