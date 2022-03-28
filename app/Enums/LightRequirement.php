<?php

namespace App\Enums;

enum LightRequirement: string {
	case FULL_SUN = 'FULL_SUN';
	case PART_SUN = 'PART_SUN';
	case PART_SHADE = 'PART_SHADE';
	case FULL_SHADE = 'FULL_SHADE';

	public function info(): string {
		return match($this) {
			LightRequirement::FULL_SUN => 'Plants need at least 6 hours of direct sun daily',
			LightRequirement::PART_SUN => 'Plants thrive with between 3 and 6 hours of direct sun per day',
			LightRequirement::PART_SHADE => 'Plants require between 3 and 6 hours of sun per day, but need protection from intense mid-day sun',
			LightRequirement::FULL_SHADE => 'Plants require less than 3 hours of direct sun per day',
		};
	}
}