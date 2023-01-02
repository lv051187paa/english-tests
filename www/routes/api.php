<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OptionController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\TestGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::apiResource('test-groups', TestGroupController::class);
Route::apiResource('tests', TestController::class);
Route::get('tests/group/{test_group_id}', [TestController::class, "getTestsByTesGroupId"]);
Route::apiResource('tests.options', OptionController::class);
Route::apiResource('answers', AnswerController::class);
