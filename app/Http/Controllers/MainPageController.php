<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $toys = Toy::latest()->limit(6)->get();
        $images = $toys->map(
            fn (Toy $toy) => $toy->getFirstMediaUrl()
        );

        return Inertia::render('Welcome', [
            'toys' => $toys,
            'images' => $images
        ]);
    }
}
