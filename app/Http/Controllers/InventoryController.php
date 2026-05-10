<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\insumos;
use App\Models\producto_insumo;

class InventoryController extends Controller
{
    public function index()
    {
        $productos = producto::all();
        $insumos = insumos::all();
        $producto_insumos = producto_insumo::with('producto', 'insumo')->get();

        return view('inventory', compact('productos', 'insumos', 'producto_insumos'));
    }
}