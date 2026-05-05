<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\insumos;
#Controlador 
class LandingController extends Controller
{
    public function index(){
        $insumos = insumos::all();
        return view('landing', compact('insumos'));
    }

    public function landingIndex(Request $request){
        return response()->json([
            'user' => $request->user(),
            'message' => 'Bienvenido a la landing page',
            'status' => 200
        ]);
    }
}
