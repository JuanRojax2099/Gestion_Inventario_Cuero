<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\insumos;

class InsumosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            // Add other validations as needed
        ]);

        insumos::create([
            'nombre' => $request->nombre,
            // Add other fields
        ]);

        return response()->json(['message' => 'Insumo creado exitosamente.']);
    }
}