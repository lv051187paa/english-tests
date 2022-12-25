<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;
use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $tests = Test::all();

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
     */
    public function store(StoreTestRequest $request)
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
     * @param  \App\Models\Test  $test
     * @return JsonResponse
     */
    public function update(StoreTestRequest $request, Test $test)
    {
        $test::update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Test Successfully Updated",
            'test' => $test
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
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
