<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class SignController extends Controller
{

#Historial de prueba en conexion web.php y api.php
    /* public function show_history()
    {
        return view('history');
    }*/
    #Crear un nuevo usuario
    public function store(Request $request){
       $validator = Validator::make($request->all(),[
            'name'=>'required|max:60',
            'email' =>'required|email',
            'password' =>'required'
        ]);
        #dato validator creado anteriormente 
        if($validator->fails()){
            $data =[
                'message'=> 'Error',
                'errors'=> $validator->errors(),
                'status'=>400
            ];
            return response() ->json($data,400);
        }#Utiliza modelo User para la creación del usaurio.
        $user = User::create([
           'name'=>$request->name,
           'email' =>$request->email,
            'password' =>$request->password 
        ]);
        if(!$user){
            $data=[
                'message'=>'Error',
                'status'=>500
            ];
            return  response()->json($data, 200);
        }
        $data =['user'=>$user,
        'status' => 201];
        return response()->json($data,201);
    }
    
    // Login con sesión (web.php)
    public function loginWeb(Request $request){
        $validated = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        
        // Intentar autenticación
        if(!Auth::attempt(['email'=> $request->email, 'password'=>$request->password])){
            return back()->with('error', 'Credenciales inválidas')->onlyInput('email');
        }
        
        // Regenerar sesión
        $request->session()->regenerate();
        
        return redirect()->intended('/landing');
    }
    
    // Logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
    
