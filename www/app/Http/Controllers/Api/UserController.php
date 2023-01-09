<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return JsonResponse
   *
   * @OA\Get(
   *     path="/users",
   *     tags={"Users"},
   *     summary="Returns a list of questions",
   *     security={ {"bearerAuth": {} }},
   *     @OA\Response(
   *        response="200",
   *        description="Successful operation",
   *         @OA\JsonContent(
   *             type="array",
   *             @OA\Items(ref="#/components/schemas/User")
   *         ),
   *     ),
   *     @OA\Response(
   *        response="401",
   *        description="Unauthorized operation"
   *     )
   * )
   */
  public function index()
  {
    $users = User::all();

    return response()->json([
      'status' => true,
      'users' => $users
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param StoreUserRequest $request
   * @return \Illuminate\Http\JsonResponse
   *
   *
   * @OA\Post(
   *     path="/users",
   *     tags={"Users"},
   *     summary="Saves user",
   *     security={ {"bearerAuth": {} }},
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
   *     ),
   *     @OA\Response(
   *        response="201",
   *        description="Successful operation",
   *         @OA\JsonContent(
   *             ref="#/components/schemas/User"
   *         ),
   *     ),
   *     @OA\Response(
   *        response="401",
   *        description="Unauthorized operation",
   *     ),
   *     @OA\Response(
   *        response="400",
   *        description="Bad request",
   *     )
   * )
   */
  public function store(StoreUserRequest $request): JsonResponse
  {
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'phone_number' => (int)$request->phone_number,
    ]);

    return response()->json([
      'status' => true,
      'message' => "User Successfully Created",
      'user' => $user
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\User $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\User $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    //
  }
}
