<?php

namespace App\Models;

use App\Enums\ActivityPeriodTime;
use App\Enums\ActivityPeriodType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jamesh\Uuid\HasUuid;

class ActivityPeriod extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'plant_id',
        'type',
        'start_month',
        'start_time',
        'end_month',
        'end_time',
    ];

    protected $casts = [
        'start_time' => ActivityPeriodTime::class,
        'end_time' => ActivityPeriodTime::class,
        'type' => ActivityPeriodType::class,
    ];
}
