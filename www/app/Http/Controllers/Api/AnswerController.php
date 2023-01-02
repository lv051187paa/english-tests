<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
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
        $answers = Answer::all()->groupBy('test_id');

        return response()->json([
            'status' => true,
            'answers' => $answers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $current_user = Auth::user();
        if(is_null($current_user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $answer = Answer::create([
            "test_id" => $request->test_id,
            "option_id" => $request->option_id,
            "user_id" => $current_user->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Answer Saved Successfully",
            'answer' => $answer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return JsonResponse
     */
    public function destroy(Answer $answer): JsonResponse
    {
        $answer->delete();

        return response()->json([
            'status' => true,
            'message' => "Answer Deleted Successfully",
        ]);
    }
}
