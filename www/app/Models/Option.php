<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     description="Option Response model",
 *     title="Option Response model",
 *     @OA\Xml(
 *         name="Option"
 *     )
 * )
 */
class Option extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *      title="ID",
     *      description="Current test id",
     *      format="int64"
     * )
     *
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="Option text",
     *     title="Option text",
     * )
     *
     * @var string
     */
    private string $text;

    /**
     * @OA\Property(
     *     format="boolean",
     *     description="MArk if current option is correct for the question",
     *     title="Is correct option flag",
     * )
     *
     * @var bool
     */
    private bool $is_correct;

    /**
     * @OA\Property(
     *      title="Test id",
     *      description="Test id for the current option",
     *      format="int64"
     * )
     *
     * @var int
     */
    private int $test_id;

    /**
     * @OA\Property(
     *     description="Test data for the current option",
     *     title="Test data",
     * )
     *
     * @var Test
     */
    private Test $test;

    protected $fillable = ['text', 'is_correct', 'test_id'];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
}
