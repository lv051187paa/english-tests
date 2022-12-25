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
