<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;
use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the tests.
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *     path="/tests",
     *     tags={"Questions"},
     *     summary="Returns a list of questions",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Test")
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
    public function index()
    {
        $tests = Test::with(["options:id,text,is_correct,test_id", "testGroup:group_name,id"])->get();

        return response()->json([
            'status' => true,
            'tests' => $tests
        ]);
    }

    /**
     * Display a listing of the tests by test group id.
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *     path="/tests/group/{test_group_id}",
     *     tags={"Questions"},
     *     summary="Returns a list of questions by test group",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *         description="Test group id",
     *         in="path",
     *         name="test_group_id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Test")
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
    public function getTestsByTestGroupId(Request $request): JsonResponse
    {
        $tests = Test::with(["options:id,text,is_correct,test_id", "testGroup:group_name,id"])
            ->where("test_group_id", $request->test_group_id)
            ->get();

        return response()->json([
            'status' => true,
            'tests' => $tests
        ]);
    }

    /**
     * Display a listing of the tests by test group id for users to answer.
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *     path="/tests/group/{test_group_id}/quiz-questions",
     *     tags={"Questions"},
     *     summary="Returns a list of questions by test group without is_correct flag for options",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *         description="Test group id",
     *         in="path",
     *         name="test_group_id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Test")
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
    public function getTestsByTestGroupIdForUser(Request $request): JsonResponse
    {
        $tests = Test::with(["options:id,text,test_id", "testGroup:group_name,id"])
            ->where("test_group_id", $request->test_group_id)
            ->get();

        return response()->json([
            'status' => true,
            'tests' => $tests
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTestRequest $request
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/tests",
     *     tags={"Questions"},
     *     summary="Saves test question for test group",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreTestRequest")
     *     ),
     *     @OA\Response(
     *        response="201",
     *        description="Successful operation",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Test"
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
    public function store(StoreTestRequest $request): JsonResponse
    {
        $test = Test::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Test Successfully Created",
            'test' => $test
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTestRequest $request
     * @param \App\Models\Test $test
     * @return JsonResponse
     *
     * @OA\Put(
     *     path="/tests",
     *     tags={"Questions"},
     *     summary="Update test question",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *         description="Question id",
     *         in="path",
     *         name="test",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreTestRequest")
     *     ),
     *     @OA\Response(
     *        response="201",
     *        description="Successful operation",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Test"
     *         ),
     *     ),
     *     @OA\Response(
     *        response="401",
     *        description="Unauthorized operation",
     *        @OA\JsonContent(
     *           type="string",
     *           description="Unauthenticated"
     *         )
     *     ),
     *     @OA\Response(
     *        response="400",
     *        description="Bad request",
     *     )
     * )
     */
    public function update(StoreTestRequest $request, Test $test)
    {
        $test->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Test Successfully Updated",
            'test' => $test
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Test $test)
    {
        $test->delete();

        return response()->json([
            'status' => true,
            'message' => "Test Successfully Deleted",
        ]);
    }
}
