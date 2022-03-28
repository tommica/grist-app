<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertAttempt;
use Illuminate\Support\Facades\Redirect;
use App\Models\Attempt;
use App\Models\Plant;
use Inertia\Inertia;

class AttemptController extends Controller
{
    public function index()
    {
        return Inertia::render('Attempt/Index', [
            'items' => Attempt::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Attempt/Form', [
            'plants' => Plant::all(),
            'attempt' => new Attempt([
                'seeded_at' => now(),
            ]),
        ]);
    }

    public function store(UpsertAttempt $request)
    {
        $data = $request->validated();
        Attempt::create($data);

        return Redirect::route('attempt.index');
    }

    public function show(Attempt $attempt)
    {
        return Inertia::render('Attempt/Show', [
            'attempt' => $attempt,
        ]);
    }

    public function edit(Attempt $attempt)
    {
        return Inertia::render('Attempt/Form', [
            'plants' => Plant::all(),
            'attempt' => $attempt,
        ]);
    }

    public function update(UpsertAttempt $request, Attempt $attempt)
    {
        $data = $request->validated();
        $attempt->update($data);

        return Redirect::route('attempt.index');
    }

    public function destroy(Attempt $attempt)
    {
        $attempt->delete();
        return Redirect::route('plant.index');
    }
}
