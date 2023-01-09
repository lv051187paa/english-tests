<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     description="Answer Response model",
 *     title="Answer Response model",
 *     @OA\Xml(
 *         name="Answer"
 *     )
 * )
 */
class Answer extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *      title="ID",
     *      description="Current answer id",
     *      format="int64"
     * )
     *
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *      title="question id",
     *      description="Current question id",
     *      format="int64"
     * )
     *
     * @var int
     */
    private int $test_id;

    /**
     * @OA\Property(
     *      title="User id",
     *      description="Current user id",
     *      format="int64"
     * )
     *
     * @var int
     */
    private int $user_id;

    /**
     * @OA\Property(
     *      title="Option id",
     *      description="Current option id",
     *      format="int64"
     * )
     *
     * @var int
     */
    private int $option_id;

    /**
     * @OA\Property(
     *      title="Test data",
     *      description="Current test data",
     * )
     *
     * @var Test
     */
    private Test $test;

    /**
     * @OA\Property(
     *      title="Option data",
     *      description="Selected Option data",
     * )
     *
     * @var Option
     */
    private Option $option;

    /**
     * @OA\Property(
     *      title="User data",
     *      description="Current User data",
     * )
     *
     * @var User
     */
    private User $user;

    protected $fillable = ['test_id', 'user_id', 'option_id'];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
