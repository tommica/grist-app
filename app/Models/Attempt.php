<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jamesh\Uuid\HasUuid;

class Attempt extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'plant_id',
        'seeded_at',
        'transplanted_at',
        'completed_at',
        'note',
    ];

    protected $casts = [
        'seeded_at' => 'datetime',
        'transplanted_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    protected $with = ['plant'];

    protected $appends = ['transplant_at', 'harvest_at'];

    public function plant() {
        return $this->belongsTo(Plant::class);
    }

    public function getTransplantAtAttribute(): ?Carbon {
        $germinationDays = $this->plant?->germination_days;

        if($germinationDays && $this->seeded_at) {
            return (clone($this->seeded_at))->addDays($germinationDays);
        }

        return null;
    }

    public function getHarvestAtAttribute(): ?Carbon {
        $maturityDays = $this->plant?->days_to_maturity;

        if($maturityDays && $this->seeded_at) {
            return (clone($this->seeded_at))->addDays($maturityDays);
        }

        return null;
    }
}
