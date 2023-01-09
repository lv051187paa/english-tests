<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *     path="/login",
     *     tags={"Auth"},
     *     summary="Login",
     *     @OA\RequestBody(
     *        required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *        @OA\JsonContent(
     *            @OA\Property(
     *                property="access_token",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                property="token_type",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                property="expires_in",
     *                type="integer",
     *            ),
     *        ),
     *     ),
     *     @OA\Response(
     *        response="403",
     *        description="Forbidden access",
     *     ),
     *     @OA\Response(
     *        response="422",
     *        description="Wrong credentials",
     *     ),
     *     @OA\Response(
     *        response="400",
     *        description="Bad request",
     *     )
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *     path="/logout",
     *     tags={"Auth"},
     *     summary="Logout",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *     ),
     *     @OA\Response(
     *        response="401",
     *        description="Unauthorized access",
     *     ),
     *     @OA\Response(
     *        response="400",
     *        description="Bad request",
     *     )
     * )
     */
    public function logout()
    {
        // handle unathorized operation
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
