<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
            ],
            'description' =>             'required|string|max:5000',
            'severity' =>              'required|in:"low","medium","high","critical"',
            'proof_of_concept' =>          'nullable|image|max:4096', // maxsize = 4Mb
        ];
    }
}
