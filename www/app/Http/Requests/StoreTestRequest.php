<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @OA\Schema(
 *      title="Store Question request",
 *      description="Store Question request body data",
 *      type="object",
 *      required={"question", "test_group_id"}
 * )
 */
class StoreTestRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="Test question",
     *      description="Test question text"
     * )
     *
     * @var string
     */
    public string $question;

    /**
     * @OA\Property(
     *      title="Test group id",
     *      description="Test group id, test is related"
     * )
     *
     * @var int
     */
    public int $test_group_id;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['question' => "string", "test_group_id" => "string"])]
    public function rules(): array
    {
        return [
            'question' => 'required',
            'test_group_id' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]));
    }
}
