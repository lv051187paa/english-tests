<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOptionRequest;
use App\Models\Option;
use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOptionRequest $request
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/tests/{testId}/options",
     *     tags={"Options"},
     *     summary="Saves question option",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *         description="Question id",
     *         in="path",
     *         name="testId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreOptionRequest")
     *     ),
     *     @OA\Response(
     *        response="201",
     *        description="Successful operation",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Option"
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
    public function store(StoreOptionRequest $request, Test $test): JsonResponse
    {

        $params = array_merge(['test_id' => $test->id], $request->all());
        $option = Option::create($params);

        return response()->json([
            'status' => true,
            'message' => "Option Created Successfully",
            'option' => $option
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOptionRequest $request
     * @param  \App\Models\Test  $test
     * @param  \App\Models\Option  $option
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/tests/{testId}/options/{optionId}",
     *     tags={"Options"},
     *     summary="Updates question option",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *         description="Question id",
     *         in="path",
     *         name="testId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Option id",
     *         in="path",
     *         name="optionId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreOptionRequest")
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Option"
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
    public function update(StoreOptionRequest $request, Test $test, Option $option): JsonResponse
    {
        $params = array_merge(['test_id' => $test->id], $request->all());
        $option->update($params);

        return response()->json([
            'status' => true,
            'message' => "Option Updated Successfully",
            'option' => $option
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @param  \App\Models\Option  $option
     * @return JsonResponse
     */
    public function destroy(Test $test, Option $option)
    {
        $option->delete();

        return response()->json([
            'status' => true,
            'message' => "Option Deleted Successfully",
        ]);
    }
}
