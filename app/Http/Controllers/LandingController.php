<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class LandingController extends Controller
{
    public function landingIndex(Request $request){
        return response()->json([
            'user' => $request->user(),
            'message' => 'Bienvenido a la landing page',
            'status' => 200
        ]);
    }
}
