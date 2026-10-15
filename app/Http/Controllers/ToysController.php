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
            fn (Toy $toy) => $toy->getFirstMediaUrl('images')
        );

        return Inertia::render('toys/index', [
            'toys' => $toys,
            'images' => $images,
        ]);
    }

    public function show(Toy $toy)
    {
        $images = $toy->getMedia('images')->map(
            fn ($media) => $media->getUrl()
        );

        return Inertia::render('toys/show', [
            'toy' => $toy,
            'images' => $images,
        ]);
    }
}
