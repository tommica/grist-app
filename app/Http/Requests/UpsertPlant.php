<?php

namespace App\Http\Requests;

use App\Enums\ActivityPeriodTime;
use App\Enums\LightRequirement;
use App\Models\ActivityPeriod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpsertPlant extends FormRequest
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
            'name' => 'string|required',
            'temperature' => 'numeric|nullable',
            'note' => 'string|nullable',
            'light_requirement' => [new Enum(LightRequirement::class)],
            'soil_condition' => 'string|nullable',
            'scientific_name' => 'string|nullable',
            'botanic_family' => 'string|nullable',
            'cultivar' => 'string|nullable',
            'plant_spacing' => 'numeric|nullable',
            'row_spacing' => 'numeric|nullable',
            'sowing_depth' => 'numeric|nullable',
            'germination_days' => 'numeric|nullable',
            'days_to_maturity' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'diameter' => 'numeric|nullable',
            'is_root' => 'boolean',
            'sow_periods' => 'nullable|array',
            'sow_periods.*' => 'required|array',
            'sow_periods.*.start_month' => 'required|numeric',
            'sow_periods.*.end_month' => 'required|numeric',
            'sow_periods.*.start_time' => ['required', new Enum(ActivityPeriodTime::class)],
            'sow_periods.*.end_time' => ['required', new Enum(ActivityPeriodTime::class)],
            'seed_periods' => 'nullable|array',
            'seed_periods.*' => 'required|array',
            'seed_periods.*.start_month' => 'required|numeric',
            'seed_periods.*.end_month' => 'required|numeric',
            'seed_periods.*.start_time' => ['required', new Enum(ActivityPeriodTime::class)],
            'seed_periods.*.end_time' => ['required', new Enum(ActivityPeriodTime::class)],
            'transplant_periods' => 'nullable|array',
            'transplant_periods.*' => 'required|array',
            'transplant_periods.*.start_month' => 'required|numeric',
            'transplant_periods.*.end_month' => 'required|numeric',
            'transplant_periods.*.start_time' => ['required', new Enum(ActivityPeriodTime::class)],
            'transplant_periods.*.end_time' => ['required', new Enum(ActivityPeriodTime::class)],
            'harvest_periods' => 'nullable|array',
            'harvest_periods.*' => 'required|array',
            'harvest_periods.*.start_month' => 'required|numeric',
            'harvest_periods.*.end_month' => 'required|numeric',
            'harvest_periods.*.start_time' => ['required', new Enum(ActivityPeriodTime::class)],
            'harvest_periods.*.end_time' => ['required', new Enum(ActivityPeriodTime::class)],
        ];
    }
}
