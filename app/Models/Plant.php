<?php

namespace App\Models;

use App\Enums\ActivityPeriodType;
use App\Enums\LightRequirement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jamesh\Uuid\HasUuid;
use Kingmaker\Illuminate\Eloquent\Relations\BelongsToManySelf;
use Kingmaker\Illuminate\Eloquent\Relations\HasBelongsToManySelfRelation;

class Plant extends Model
{
    use HasFactory, HasUuid, HasBelongsToManySelfRelation;

    protected $fillable = [
        'name',
        'temperature',
        'note',
        'light_requirement',
        'soil_condition',
        'scientific_name',
        'botanic_family',
        'cultivar',
        'plant_spacing',
        'row_spacing',
        'sowing_depth',
        'germination_days',
        'days_to_maturity',
        'height',
        'diameter',
        'is_root',
    ];

    protected $casts = [
        'is_root' => 'boolean',
        'light_requirement' => LightRequirement::class,
    ];

    protected $with = ['seedPeriods', 'transplantPeriods', 'sowPeriods', 'harvestPeriods'];

    public function seedPeriods(): HasMany
    {
        return $this->hasMany(ActivityPeriod::class)->where('type', '=', ActivityPeriodType::SEED);
    }

    public function transplantPeriods(): HasMany
    {
        return $this->hasMany(ActivityPeriod::class)->where('type', '=', ActivityPeriodType::TRANSPLANT);
    }

    public function sowPeriods(): HasMany
    {
        return $this->hasMany(ActivityPeriod::class)->where('type', '=', ActivityPeriodType::SOW);
    }

    public function harvestPeriods(): HasMany
    {
        return $this->hasMany(ActivityPeriod::class)->where('type', '=', ActivityPeriodType::HARVEST);
    }

    public function companions(): BelongsToManySelf
    {
        return $this->belongsToManySelf('companion_plants', 'plant_1_id', 'plant_2_id')->withPivot('is_positive');
    }

    public function setHarvestPeriods(array|null|Collection $periods): self
    {
        return $this->setPeriods(ActivityPeriodType::HARVEST, $periods);
    }

    public function setSeedPeriods(array|null|Collection $periods): self
    {
        return $this->setPeriods(ActivityPeriodType::SEED, $periods);
    }

    public function setSowPeriods(array|null|Collection $periods): self
    {
        return $this->setPeriods(ActivityPeriodType::SOW, $periods);
    }

    public function setTransplantPeriods(array|null|Collection $periods): self
    {
        return $this->setPeriods(ActivityPeriodType::TRANSPLANT, $periods);
    }

    private function setPeriods(ActivityPeriodType $type, array|null|Collection $periods): self
    {
        $key = match ($type) {
            ActivityPeriodType::SOW => 'sowPeriods',
            ActivityPeriodType::SEED => 'seedPeriods',
            ActivityPeriodType::TRANSPLANT => 'transplantPeriods',
            ActivityPeriodType::HARVEST => 'harvestPeriods'
        };

        $this->$key()->delete();
        $data = [];
        if (is_iterable($periods) && count($periods)) {
            foreach ($periods as $period) {
                $tmp = (array)$period;
                $tmp['plant_id'] = $this->getKey();
                $tmp['type'] = $type;
                $tmp['id'] = Str::UUID();
                $data[] = $tmp;
            }
        }

        if (count($data)) {
            ActivityPeriod::insert($data);
        }

        return $this;
    }
}
