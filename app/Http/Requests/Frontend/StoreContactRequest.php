<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreContactRequest extends FormRequest
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
    #[ArrayShape(['fullname' => "string[]", 'email' => "string[]", 'phone' => "string[]", 'topic' => "string[]", 'message' => "string[]"])] public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'string', 'max:15'],
            'topic' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }
}
