<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreJobRequest
 *
 * @package App\Http\Requests
 */
class StoreJobRequest extends FormRequest
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
     */
    public function rules(): array
    {
        // Todo: complete validation rules
        return [
            'title' => ['required', 'string'],
            'company' => ['required', 'string'],
            'companyUrl' => ['required', 'url'],
            'jobUrl' => ['required', 'url'],
            'description' => ['nullable', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'remotePolicy' => ['required'],
            'experienceLevel' => ['required'],
            'jobType' => ['required'],
            'salaryRangeMin' => ['required', 'integer'],
            'salaryRangeMax' => ['required', 'integer'],
            'tags' => ['nullable'],
        ];
    }
}
