<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\entregas;
use App\Models\factura;
//Añadir El factory Method a los controladores
class EntregasController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'factura_id'=>'required|max:60',
            'fecha' =>'required|datetime',
            'cliente' =>'required'
        ]);
        if($validator->fails()){
            $data =[
                'message'=> 'Error',
                'errors'=> $validator->errors(),
                'status'=>400
            ];
            return response() ->json($data,400);
        }
        $entrega = entregas::create([
           'factura_id'=>$request->factura_id,
           'fecha' =>$request->fecha,
            'cliente' =>$request->cliente 
        ]);
        if(!$entrega){
            $data=[
                'message'=>'Error',
                'status'=>500
            ];
            return response()->json($data, 500);
        }
        $data =[
            'message'=>'Entrega creada correctamente',
            'entrega'=>$entrega,
            'status'=>201
        ];
        return response()->json($data, 201);
    }
  public function GetEntregas(){
    $entregas = entregas::all();
    
    #Transformar los datos para FullCalendar
    $eventos = $entregas->map(function($entrega) {
        return [
            'id' => $entrega->id,
            'title' => 'Entrega: ' . $entrega->cliente,
            'date' => $entrega->fecha,
            'extendedProps' => [
                'factura_id' => $entrega->factura_id,
                'cliente' => $entrega->cliente,
                'fecha' => $entrega->fecha
            ]
        ];
    });
    
    return response()->json($eventos, 200);
  }

  public function show($id){
    $entrega = entregas::find($id);
    if(!$entrega){
        return response()->json([
            'message' => 'Entrega no encontrada',
            'status' => 404
        ], 404);
    }
    return response()->json($entrega, 200);
  }

  public function showFactura($id){
    $factura = factura::find($id);
    if(!$factura){
        return response()->json([
            'message' => 'Factura no encontrada',
            'status' => 404
        ], 404);
    }
    return response()->json($factura, 200);
  }
  
  public function destroy($id){
    $entrega = entregas::find($id);
    
    if(!$entrega){
        return response()->json([
            'message'=>'Entrega no encontrada',
            'status'=>404
        ], 404);
    }

    $entrega->delete();
    
    return response()->json([
        'message'=>'Entrega eliminada correctamente',
        'status'=>200
    ], 200);
  }
}