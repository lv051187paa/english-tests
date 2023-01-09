<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     description="Test Group Response model",
 *     title="Test Group Response model",
 *     @OA\Xml(
 *         name="TestGroup"
 *     )
 * )
 */
class TestGroup extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *      title="ID",
     *      description="Current test group id",
     *      format="int64"
     * )
     *
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *     format="string",
     *     description="Test group name",
     *     title="Test group name",
     * )
     *
     * @var string
     */
    private string $group_name;

    /**
     * @OA\Property(
     *     format="array",
     *     description="List of test questions",
     *     title="Questions list",
     *     @OA\Items(
     *         ref="#/components/schemas/Test"
     *     )
     * )
     *
     * @var array
     */
    private array $tests;

    protected $fillable = ["group_name"];

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
