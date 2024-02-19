<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'title' => ['required'],
            'company' => ['required'],
            'companyUrl' => ['nullable', 'url'],
            'jobUrl' => ['required', 'url'],
            'description' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'remotePolicy' => ['nullable'],
            'experienceLevel' => ['nullable'],
            'jobType' => ['nullable'],
            'salaryRangeMin' => ['nullable', 'integer'],
            'salaryRangeMax' => ['nullable', 'integer'],
            'tags' => ['nullable'],
        ];
    }
}
