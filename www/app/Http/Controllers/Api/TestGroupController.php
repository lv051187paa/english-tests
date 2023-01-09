<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestGroupRequest;
use App\Models\TestGroup;
use Illuminate\Http\JsonResponse;

class TestGroupController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  /**
   * Display a listing of the resource.
   *
   * @return JsonResponse
   *
   * @OA\Get(
   *     path="/test-groups",
   *     tags={"Tests"},
   *     summary="Returns a list of tests",
   *     security={ {"bearerAuth": {} }},
   *     @OA\Response(
   *        response="200",
   *        description="Successful operation",
   *         @OA\JsonContent(
   *             type="array",
   *             @OA\Items(ref="#/components/schemas/TestGroup")
   *         ),
   *     ),
   *     @OA\Response(
   *        response="401",
   *        description="Unauthorized operation",
   *            @OA\JsonContent(
   *              type="string",
   *              description="Unauthenticated"
   *            )
   *     )
   * )
   */
  public function index(): JsonResponse
  {
    $test_groups = TestGroup::with("tests:id,question,test_group_id")->get();

    return response()->json([
      'status' => true,
      'groups' => $test_groups
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param StoreTestGroupRequest $request
   * @return JsonResponse
   *
   * @OA\Post(
   *     path="/test-groups",
   *     tags={"Tests"},
   *     summary="Saves test name",
   *     security={ {"bearerAuth": {} }},
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(ref="#/components/schemas/StoreTestGroupRequest")
   *     ),
   *     @OA\Response(
   *        response="201",
   *        description="Successful operation",
   *         @OA\JsonContent(
   *             ref="#/components/schemas/TestGroup"
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
  public function store(StoreTestGroupRequest $request): JsonResponse
  {
    $test_group = TestGroup::create($request->all());

    return response()->json([
      'status' => true,
      'message' => "Test Group Successfully Created",
      'group' => $test_group
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param StoreTestGroupRequest $request
   * @param TestGroup $test_group
   * @return JsonResponse
   *
   * @OA\Put(
   *     path="/test-groups",
   *     tags={"Tests"},
   *     summary="Saves test name",
   *     security={ {"bearerAuth": {} }},
   *     @OA\Parameter(
   *         description="Test id",
   *         in="path",
   *         name="test_group",
   *         required=true,
   *         @OA\Schema(
   *             type="integer",
   *             format="int64"
   *         )
   *     ),
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(ref="#/components/schemas/StoreTestGroupRequest")
   *     ),
   *     @OA\Response(
   *        response="201",
   *        description="Successful operation",
   *         @OA\JsonContent(
   *             ref="#/components/schemas/TestGroup"
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
  public function update(StoreTestGroupRequest $request, TestGroup $test_group): JsonResponse
  {
    $test_group->update($request->all());

    return response()->json([
      'status' => true,
      'message' => "Test Group Successfully Updated",
      'group' => $test_group
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param TestGroup $test_group
   * @return JsonResponse
   */
  public function destroy(TestGroup $test_group): JsonResponse
  {
    $test_group->delete();

    return response()->json([
      'status' => true,
      'message' => "Test Group Successfully Deleted",
    ]);
  }
}
