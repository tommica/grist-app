<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertAttempt extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !!$this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plant_id' => 'required|string',
            'seeded_at' => 'date|required',
            'transplanted_at' => 'date|nullable',
            'completed_at' => 'date|nullable',
            'note' => 'nullable|string',
        ];
    }
}
