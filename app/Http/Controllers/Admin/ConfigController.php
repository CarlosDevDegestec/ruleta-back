<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RouletteConfig;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function edit()
    {
        $config = RouletteConfig::current();
        return view('admin.config.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'subtitle'  => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $config = RouletteConfig::current();
        $config->update([
            'title'     => $request->title,
            'subtitle'  => $request->subtitle,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.config.edit')->with('success', 'Configuración actualizada correctamente.');
    }
}
