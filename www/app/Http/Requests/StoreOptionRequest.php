<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @OA\Schema(
 *      title="Store Option request",
 *      description="Store Option request body data",
 *      type="object",
 *      required={"text","is_correct"}
 * )
 */
class StoreOptionRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="Option text",
     *      description="Option text"
     * )
     *
     * @var string
     */
    public string $text;

    /**
     * @OA\Property(
     *      title="Is correct option",
     *      description="Flag for correct test option"
     * )
     *
     * @var bool
     */
    public bool $is_correct;

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
    #[ArrayShape(['text' => "string", 'is_correct' => "string"])]
    public function rules()
    {
        return [
            'text' => "required|max:70",
            'is_correct' => "required"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]));
    }
}
