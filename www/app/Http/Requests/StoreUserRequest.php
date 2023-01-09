<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 *      type="object",
 *      required={"name", "email", "password", "phone_number"},
 *      @OA\Property(
 *          title="User name",
 *          description="User name",
 *          property="name",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          title="User email",
 *          description="User email",
 *          property="email",
 *          type="string",
 *          format="email"
 *      ),
 *      @OA\Property(
 *          title="User password",
 *          description="User password",
 *          property="password",
 *          type="string",
 *      ),
 *      @OA\Property(
 *          title="User phone number",
 *          description="User phone number",
 *          property="phone_number",
 *          type="integer"
 *      )
 * )
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required|min:7',
          'phone_number' => 'required|digits:12'
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
