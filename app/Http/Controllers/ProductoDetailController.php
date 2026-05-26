<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;

class ProductoDetailController extends Controller
{
    public function show($id)
    {
        $producto = producto::find($id);
        if (! $producto) {
            return redirect('/admin/inventory')->with('error', 'Producto no encontrado.');
        }

        return view('admin.ProductosDetail', ['producto' => $producto]);
    }

    public function showApi($id)
    {
        $producto = producto::find($id);
        if (! $producto) {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }

        return response()->json($producto, 200);
    }

    public function update(Request $request, $id)
    {
        $producto = producto::find($id);
        if (! $producto) {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripción' => 'nullable|string',
            'precio_unitario' => 'nullable|numeric',
        ]);

        $producto->update($request->only(['nombre', 'descripción', 'precio_unitario']));

        return response()->json(['message' => 'Producto actualizado correctamente.'], 200);
    }

    public function destroy($id)
    {
        $producto = producto::find($id);
        if (! $producto) {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }

        $producto->delete();
        return response()->json(['message' => 'Producto eliminado correctamente.'], 200);
    }
}
