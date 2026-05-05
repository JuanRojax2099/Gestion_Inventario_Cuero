<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\insumos;

class ProductoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'insumos' => 'required|array',
            'insumos.*' => 'exists:insumos,id',
            // Add other validations
        ]);

        $producto = producto::create([
            'nombre' => $request->nombre,
            // Add other fields
        ]);

        $producto->insumos()->attach($request->insumos);

        return response()->json(['message' => 'Producto creado exitosamente.']);
    }
}