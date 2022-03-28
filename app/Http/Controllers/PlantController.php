<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertPlant;
use App\Models\Plant;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PlantController extends Controller
{
    public function index()
    {
        return Inertia::render('Plant/Index', [
            'plants' => Plant::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Plant/Form', [
            'plant' => new Plant([
                'is_root' => false,
            ]),
        ]);
    }

    public function store(UpsertPlant $request)
    {
        $data = $request->validated();
        $plant = Plant::create($data);

        $plant->setSeedPeriods(data_get($data, 'seed_periods'));
        $plant->setSowPeriods(data_get($data, 'sow_periods'));
        $plant->setHarvestPeriods(data_get($data, 'harvest_periods'));
        $plant->setTransplantPeriods(data_get($data, 'transplant_periods'));

        return Redirect::route('plant.index');
    }

    public function show(Plant $plant)
    {
        return Inertia::render('Plant/Show', [
            'plant' => $plant,
        ]);
    }

    public function edit(Plant $plant)
    {
        return Inertia::render('Plant/Form', [
            'plant' => $plant,
        ]);
    }

    public function update(UpsertPlant $request, Plant $plant)
    {
        $data = $request->validated();
        $plant->update($data);

        $plant->setSeedPeriods(data_get($data, 'seed_periods'));
        $plant->setSowPeriods(data_get($data, 'sow_periods'));
        $plant->setHarvestPeriods(data_get($data, 'harvest_periods'));
        $plant->setTransplantPeriods(data_get($data, 'transplant_periods'));

        return Redirect::route('plant.index');
    }

    public function destroy(Plant $plant)
    {
        $plant->delete();
        return Redirect::route('plant.index');
    }
}
