<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestGroupRequest;
use App\Models\TestGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
