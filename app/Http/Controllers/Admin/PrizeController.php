<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prize;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    public function index()
    {
        $prizes = Prize::all();
        $totalWeight = $prizes->sum('weight');
        return view('admin.prizes.index', compact('prizes', 'totalWeight'));
    }

    public function create()
    {
        return view('admin.prizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'rarity'    => 'required|in:comun,poco_comun,raro,epico,legendario',
            'weight'    => 'required|integer|min:1|max:100',
            'is_active' => 'boolean',
        ]);

        Prize::create([
            'name'      => $request->name,
            'rarity'    => $request->rarity,
            'weight'    => $request->weight,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.prizes.index')->with('success', 'Premio creado correctamente.');
    }

    public function edit(Prize $prize)
    {
        return view('admin.prizes.edit', compact('prize'));
    }

    public function update(Request $request, Prize $prize)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'rarity'    => 'required|in:comun,poco_comun,raro,epico,legendario',
            'weight'    => 'required|integer|min:1|max:100',
            'is_active' => 'boolean',
        ]);

        $prize->update([
            'name'      => $request->name,
            'rarity'    => $request->rarity,
            'weight'    => $request->weight,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.prizes.index')->with('success', 'Premio actualizado correctamente.');
    }

    public function destroy(Prize $prize)
    {
        $prize->delete();
        return redirect()->route('admin.prizes.index')->with('success', 'Premio eliminado.');
    }
}
