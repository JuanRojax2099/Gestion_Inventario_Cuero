<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\insumos;
use App\Models\producto;
use App\Models\producto_insumo;
use Illuminate\Support\Facades\Http;


class InsumosController extends Controller
{
    public $insumos;
    public $Producto;
    public $ProductoInsumo;

    public function __construct(){    
        $this->insumos = insumos::all();
        $this->Producto = producto::all();
        $this->ProductoInsumo = producto_insumo::all();
    }
    public function index(Request $request){
        $producto = $this->Producto;
        $allProductoInsumo = $this->ProductoInsumo;

        $allInsumos = insumos::all();
        $insumoQuery = insumos::query();
        $selectedCategory = $request->input('categoria');
        $selectedProductId = $request->input('producto_id');

        if ($selectedCategory) {
            $insumoQuery->where('categoria', $selectedCategory);
        }

        $insumo = $insumoQuery->get();
        $productosById = $producto->pluck('nombre','id');
        $insumosById = $allInsumos->pluck('name','id');
        $categorias = $allInsumos->pluck('categoria')->unique()->sort()->values();
        $totalInsumos = $allInsumos->count();
        $totalProductos = $producto->count();
        $filteredInsumosCount = $insumo->count();

        $productoinsumo = $allProductoInsumo;

        return view('admin.inventory', compact(
            'insumo',
            'producto',
            'productoinsumo',
            'allProductoInsumo',
            'productosById',
            'insumosById',
            'totalInsumos',
            'totalProductos',
            'filteredInsumosCount',
            'categorias',
            'selectedCategory',
            'selectedProductId'
        ));
    }
    private function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            // Add other validations as needed
        ]);

        insumos::create([
            'name' => $request->nombre,
            // Add other fields
        ]);

        return response()->json(['message' => 'Insumo creado exitosamente.']);
    }

    public function show($id)
    {
        $insumo = insumos::find($id);
        if (!$insumo) {
            return response()->json(['message' => 'Insumo no encontrado.'], 404);
        }
        return response()->json($insumo, 200);
    }

    public function update(Request $request, $id)
    {
        $insumo = insumos::find($id);
        if (!$insumo) {
            return response()->json(['message' => 'Insumo no encontrado.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'unidad' => 'nullable|string|max:100',
            'cantidad' => 'nullable|numeric',
            'categoria' => 'nullable|string|max:100',
            'proveedor' => 'nullable|string|max:255',
        ]);

        $insumo->update($request->only(['name', 'unidad', 'cantidad', 'categoria', 'proveedor']));
        return response()->json(['message' => 'Insumo actualizado correctamente.'], 200);
    }

    public function destroy($id)
    {
        $insumo = insumos::find($id);
        if (!$insumo) {
            return response()->json(['message' => 'Insumo no encontrado.'], 404);
        }

        $insumo->delete();
        return response()->json(['message' => 'Insumo eliminado correctamente.'], 200);
    }
}