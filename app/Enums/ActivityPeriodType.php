<?php

namespace App\Enums;

enum ActivityPeriodType: string {
	case SEED = 'SEED';
	case TRANSPLANT = 'TRANSPLANT';
	case SOW = 'SOW';
	case HARVEST = 'HARVEST';
}