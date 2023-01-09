<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Carbon\Carbon;
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
    $answers = Answer::with(['test:question,id', 'option:id,text,is_correct', 'user:id,name,email'])->get()->groupBy('test_id');

    return response()->json([
      'status' => true,
      'answers' => $answers
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return JsonResponse
   */
  public function store(Request $request): JsonResponse
  {
    $current_user = Auth::user();
    if (is_null($current_user)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    $add_item = function ($item) {
      $now = Carbon::now('utc')->toDateTimeString();
      return [
        ...$item,
        "user_id" => Auth::user()->id,
        'created_at' => $now,
        'updated_at' => $now
      ];
    };

    $answer = Answer::insert(array_map($add_item, $request->all()));

    return response()->json([
      'status' => true,
      'message' => "Answer Saved Successfully",
      'answer' => $answer,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\Answer $answer
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Answer $answer)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Answer $answer
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
