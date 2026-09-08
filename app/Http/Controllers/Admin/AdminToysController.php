<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Toy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminToysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toys = Toy::all();

        return Inertia::render('Dashboard', [
            'toysProps' => $toys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('toys/admin/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'name' => 'string|required|max:255',
            'description' => 'string|required',
            'price' => 'decimal:0.00|required',
        ]);

        $toy = Toy::create($validated);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Toy post created!')]);

        return redirect()->route('admintoys.show', [
            'toy' => $toy,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Toy $toy)
    {
        return Inertia::render('toys/admin/show', [
            'toy' => $toy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toy $toy)
    {
        return Inertia::render('toys/admin/edit', [
            'toy' => $toy,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Toy $toy)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'name' => 'string|required|max:255',
            'description' => 'string|required',
            'price' => 'decimal:0.00|required',
            'sold' => 'boolean|required',
        ]);

        $toy->update($validated);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Toy post updated!')]);

        return redirect()->route('admintoys.show', [
            'toy' => $toy,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toy $toy)
    {
        $toy->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Toy deleted')]);

        return redirect('/dashboard');
    }
}
