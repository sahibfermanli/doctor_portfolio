<?php

namespace App\Http\Requests\Backend\Skills;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use JetBrains\PhpStorm\ArrayShape;

class SkillRequest extends FormRequest
{
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
     * @return array
     */
    #[ArrayShape(['name' => "string[]", 'description' => "string[]", 'experience' => "string[]"])] public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'description' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'date'],
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 422));
    }
}
