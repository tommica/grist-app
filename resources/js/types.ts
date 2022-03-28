export interface PlantType {
	id: string | null;
	name: string | null;
	temperature: string | null;
    note: string | null;
    light_requirement: "FULL_SUN" | "PART_SUN" | "PART_SHADE" | "FULL_SHADE";
    soil_condition: string | null;
    scientific_name: string | null;
    botanic_family: string | null;
    cultivar: string | null;
    plant_spacing: number | null;
    row_spacing: number | null;
    sowing_depth: number | null;
    germination_days: number | null;
    days_to_maturity: number | null;
    height: number | null;
    diameter: number | null;
    is_root: boolean | null;
    sow_periods: ActivityPeriod[];
    seed_periods: ActivityPeriod[];
    transplant_periods: ActivityPeriod[];
    harvest_periods: ActivityPeriod[];
}

export interface ActivityPeriod {
    start_month: number;
    end_month: number;
    start_time: "START" | "MID" | "END";
    end_time: "START" | "MID" | "END";
}

export interface AttemptType {
    id: string | null;
    plant: PlantType;
    seeded_at: string | null;
    transplanted_at: string | null;
    transplant_at: string | null;
    completed_at: string | null;
    harvest_at: string | null;
    note: string | null;
}