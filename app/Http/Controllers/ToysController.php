<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Inertia\Inertia;

class ToysController extends Controller
{
    public function index()
    {
        $toys = Toy::all();
        $images = $toys->map(
            fn (Toy $toy) => $toy->getFirstMediaUrl()
        );

        return Inertia::render('toys/index', [
            'toysProps' => $toys,
            'images' => $images,
        ]);
    }

    public function show(Toy $toy)
    {
        $images = $toy->getMedia('images')->map(
            fn ($media) => $media->getUrl()
        );

        return Inertia::render('toys/show', [
            'toyProps' => $toy,
            'images' => $images,
        ]);
    }
}
