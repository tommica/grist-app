<?php

namespace Database\Seeders;

#use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\ActivityPeriodTime;
use App\Enums\ActivityPeriodType;
use App\Enums\LightRequirement;
use App\Models\ActivityPeriod;
use App\Models\Attempt;
use Illuminate\Database\Seeder;
use App\Models\Plant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $pass = config('app.env') != 'production' ? 'ch4ng3M3' : Str::random();

        User::create([
            'name' => 'root',
            'email' => 'root@test.test',
            'password' => Hash::make($pass),
        ]);

        $this->plant1();
        $this->plant2();
        $this->plant3();
        $this->plant4();
        $this->plant5();
        $this->plant6();
        $this->plant7();
        $this->plant8();
        $this->plant9();
    }

    private function plant1()
    {
        $plant = Plant::create([
            'name' => "Isop (rosa)",
            'note' => "Spirer efter 2-3 uger ved 10-20 grader. Planteafstand 30cm. Pebret krydderurt, god i kraftige kødretter med tomat. Virker afskrækkende på bl.a. kålorme og snegle.",
            'light_requirement' => LightRequirement::PART_SUN,
            'germination_days' => 15,
            'days_to_maturity' => 80,
            'height' => 50,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 1,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 4,
            'end_time' => ActivityPeriodTime::END,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SOW,
            'start_month' => 5,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 5,
            'end_time' => ActivityPeriodTime::END,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::TRANSPLANT,
            'start_month' => 5,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 5,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }

    private function plant2()
    {
        $plant = Plant::create([
            'name' => "Blomsterkarse",
            'note' => "Sådybde 1cm, planteafstand 25cm, Sol og halvskygge, velegnet til bed og krukke. Kan spises!",
            'light_requirement' => LightRequirement::PART_SUN,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 3,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 4,
            'end_time' => ActivityPeriodTime::END,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SOW,
            'start_month' => 5,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 5,
            'end_time' => ActivityPeriodTime::END,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::TRANSPLANT,
            'start_month' => 5,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 5,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }

    private function plant3()
    {
        $plant = Plant::create([
            'name' => "Lavendel",
            'note' => "Frøene dækkes ganske let med jord. Udplantes når de er 5-6cm høje. Planteafstand 40cm. Blomsterne kan spises.",
            'light_requirement' => LightRequirement::PART_SUN,
            'germination_days' => 15,
            'days_to_maturity' => 100,
            'height' => 40,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 2,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 5,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }

    private function plant4()
    {
        $plant = Plant::create([
            'name' => "Tagete African Marigold Snowdrift",
            'note' => "Sås horisontalt, dæk med tyndt lag jord.  Spirer efter 7-14 dage. Blomstrer juli-september. Plant udendørs når risiko for nattefrost er ovre, er følsom overfor frost!",
            'light_requirement' => LightRequirement::PART_SUN,
            'germination_days' => 6,
            'height' => 50,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 3,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 4,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }

    private function plant5()
    {
        $plant = Plant::create([
            'name' => "Tagete Red Brocade",
            'note' => "Sås horisontalt, dæk med tyndt lag jord.  Spirer efter 7-14 dage. Blomstrer juni-september. Plant udendørs når risiko for nattefrost er ovre, er følsom overfor frost! Hærd inden udplantning ved at sætte dem udenfor i dagtimerne i et par uger, derefter et par døgn, udplant.",
            'light_requirement' => LightRequirement::FULL_SUN,
            'germination_days' => 10,
            'height' => 25,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 3,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 4,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }

    private function plant6()
    {
        $plant = Plant::create([
            'name' => "Paprika California Wonder",
            'temperature' => 23,
            'note' => "Den gror efter 8-20 dage ved temperatur 22-25grader. Omplantes til potte med plantejord. Må ikke komme ud før temperaturen konstant er over 12 grader. Tilfør jævnligt næring. Frugterne kan spises fra grøn til rød stadie.",
            'light_requirement' => LightRequirement::FULL_SUN,
            'germination_days' => 12,
            'height' => 50,
            'days_to_maturity' => 75,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 2,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 3,
            'end_time' => ActivityPeriodTime::END,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 7,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 10,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }

    private function plant7()
    {
        $plant = Plant::create([
            'name' => "Peber, Rød - Quadranta d'Asti Rosso",
            'note' => "plante x rækkeafstand 40 x 80cm. Dyrkes mellem tomater og agurker i drivhus elller lun terrasse",
            'light_requirement' => LightRequirement::FULL_SUN,
            'germination_days' => 12,
            'height' => 50,
            'days_to_maturity' => 77,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 1,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 3,
            'end_time' => ActivityPeriodTime::END,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::TRANSPLANT,
            'start_month' => 5,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 6,
            'end_time' => ActivityPeriodTime::END,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 7,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 10,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }

    private function plant8()
    {
        $plant = Plant::create([
            'name' => "Brutus - tomater",
            'temperature' => 20,
            'note' => "It is recommended to train it for 2 main stems. Pruning and staking is a must",
            'light_requirement' => LightRequirement::FULL_SUN,
            'germination_days' => 12,
            'height' => 180,
            'days_to_maturity' => 112,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 2,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 2,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }

    private function plant9()
    {
        $plant = Plant::create([
            'name' => "Striped Stuffer - tomater",
            'temperature' => 20,
            'note' => "Udplantes til pottte et solrigt og vindstille sted.",
            'light_requirement' => LightRequirement::FULL_SUN,
            'germination_days' => 15,
            'height' => 200,
            'days_to_maturity' => 85,
        ]);

        ActivityPeriod::create([
            'plant_id' => $plant->getKey(),
            'type' => ActivityPeriodType::SEED,
            'start_month' => 2,
            'start_time' => ActivityPeriodTime::START,
            'end_month' => 2,
            'end_time' => ActivityPeriodTime::END,
        ]);

        $started = Carbon::parse('2022-03-21 13:00');
        Attempt::create([
            'seeded_at' => $started,
            'plant_id' => $plant->getKey()
        ]);
    }
}
