<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateJobRequest
 *
 * @package App\Http\Requests
 */
class UpdateJobRequest extends FormRequest
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
            'user_id' => ['required'],
            'title' => ['nullable'],
            'company' => ['nullable'],
            'companyUrl' => ['nullable', 'url'],
            'jobUrl' => ['nullable', 'url'],
            'description' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'remotePolicy' => ['required'],
            'experienceLevel' => ['required'],
            'jobType' => ['required'],
            'salaryRangeMin' => ['required', 'integer'],
            'salaryRangeMax' => ['required', 'integer'],
            'tags' => ['nullable'],
        ];
    }
}
