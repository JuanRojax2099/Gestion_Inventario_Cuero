<?php
#Controlador de prueba para la guia 5 en manejo de la clase de negocios
#Los productos son ese negocio
namespace App\Http\Controllers;
use app\FactoryMethod\factoryModel;
use Illuminate\Http\Request;

class usercontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function getId(){}
    public function index(){}
}
