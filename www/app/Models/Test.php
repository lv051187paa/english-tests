<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     description="Test Response model",
 *     title="Test Response model",
 *     @OA\Xml(
 *         name="Test"
 *     )
 * )
 */
class Test extends Model
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
     *     description="Test question",
     *     title="Test question",
     * )
     *
     * @var string
     */
    private string $question;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="Test group id",
     *     title="Test group id",
     *     property="test_group_id"
     * )
     *
     * @var int
     */
    private int $test_group_id;

    /**
     * @OA\Property(
     *     description="Test group id",
     *     title="Test group id",
     *     property="test_group"
     * )
     *
     * @var TestGroup
     */
    private TestGroup $test_group;

    /**
     * @OA\Property(
     *     description="List of options for the current test",
     *     title="List of options",
     *     type="array",
     *     @OA\Items(
     *         ref="#/components/schemas/Option"
     *     )
     * )
     *
     * @var array
     */
    private array $options;

    protected $fillable = ['question', 'test_group_id'];
    protected $with = ['options:id,text,is_correct,test_id'];

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function testGroup(): BelongsTo
    {
        return $this->belongsTo(TestGroup::class);
    }
}
