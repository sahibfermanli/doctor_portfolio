<?php

namespace App\Http\Requests\Backend\Doctor;

use App\Models\Doctor;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'image' => ['required'],
            'name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
            'father_name' => ['required', 'string', 'max:50'],
            'birthday' => ['required', 'date'],
            'profession' => ['required', 'string', 'max:100'],
            'short_about' => ['required', 'string', 'max:100'],
            'about' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:15', Rule::unique(Doctor::class, 'phone')->ignore($this->route('doctor'), 'id')],
            'email' => ['required', 'email', 'max:100', Rule::unique(Doctor::class, 'email')->ignore($this->route('doctor'), 'id')],
            'location' => ['required', 'string', 'max:100'],
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
