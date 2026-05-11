<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\insumos;
use App\Models\producto;
use App\Models\producto_insumo;

class InsumosController extends Controller
{
    public function index(){
        $consulta = insumos::all();
        $productos = producto::all();
        $producto_insumo = producto_insumo::all();
        return view('admin.inventory',compact('consulta', 'productos', 'producto_insumo'));
    }
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