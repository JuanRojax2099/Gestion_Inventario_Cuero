<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\SignController;
use App\Http\Controllers\EntregasController;
use App\Http\Controllers\InsumosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoDetailController;
Route::get('/Login', function () {
    return view('index');
});
Route::get('/', function () {
    return view('index');
});
Route::post('/validate', [SignController::class, 'loginWeb'])->name('validate');
Route::get('/logout', [SignController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/landing', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
    Route::get('/historial', function () {
        $historialClientes = App\Models\historialcliente::orderBy('id', 'desc')->get();
        $historialProveedores = App\Models\historialproveedor::orderBy('id', 'desc')->get();
        return view('history', compact('historialClientes', 'historialProveedores'));
    });
    Route::get('/calendario', function () {
        return view('schedule');
    })->name('calendario');
    Route::get('/calendario/CrearEntrega',function(){
        return view('Admin.CreateDelivery');
    })->name('CreateDelivery');
    Route::post('/insumos', [InsumosController::class, 'store'])->name('insumos.store');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/inventario',[InsumosController::class,'index'])->name('inventario');
    Route::get('/admin/inventory',[InsumosController::class,'index'])->name('admin.inventory');
    Route::get('/admin/insumo/{id}', function ($id) {
        $insumo = App\Models\insumos::find($id);
        if (!$insumo) {
            return redirect('/admin/inventory')->with('error', 'Insumo no encontrado.');
        }
        return view('admin.InsumosDetail', ['insumo' => $insumo]);
    })->name('admin.insumo.detail');
    Route::get('/admin/producto/{id}', [ProductoDetailController::class, 'show'])->name('admin.producto.detail');
    Route::get('/admin/factura/{id}', [EntregasController::class, 'showFacturaDetails'])->name('admin.factura.details');
    Route::get('/supplier/create-object', function () {
        $insumos = App\Models\insumos::all();
        $cliente = App\Models\cliente::all();
        $proveedores = App\Models\proveedores::all();
        return view('Supplier.CreateObject', compact('insumos', 'cliente', 'proveedores'));
    })->name('supplier.createobject');
});
