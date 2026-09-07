<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ToysController extends Controller
{
    public function index()
    {
        $toys = Toy::all();

        return Inertia::render('Welcome', [
            'toysProps' => $toys,
        ]);
    }

    public function show(Toy $toy)
    {
        return Inertia::render('toys/show', [
            'toyProps' => $toy,
        ]);
    }


}
