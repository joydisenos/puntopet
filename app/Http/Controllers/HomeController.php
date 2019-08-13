<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Legal;
use App\Negocio;
use App\Hogar;
use App\Producto;

class HomeController extends Controller
{
   
    public function index()
    {
        $tiendasRef = new Negocio();
        $tiendas = $tiendasRef->tiendasSlider();
        $productosRef = new Producto();
        $productos = $productosRef->productosHome();
        
        return view('home' , compact('tiendas' , 'productos'));
    }

    public function bienvenido()
    {
        return view('bienvenido');
    }

    public function nosotros($pagina = null)
    {
        if($pagina == null)
        {
            $legal = Legal::where('slug' , 'nosotros')->first();
        }else{
            $legal = Legal::where('slug' , $pagina)->first();
        }

        return view('legales' , compact('legal'));
    }

    public function tiendas()
    {
        $tiendasRef = new Negocio();
        $tiendas = $tiendasRef->tiendas();

        return view('tiendas' , compact('tiendas'));
    }

    public function hogares()
    {
        $tiendasRef = new Hogar();
        $tiendas = $tiendasRef->hogares();

        return view('hogares' , compact('tiendas'));
    }

    public function hogar($slug)
    {
        $hogar = Hogar::where('slug' , $slug)->first();
        //$productos = $tienda->productos;
        
        return view('hogar' , compact('hogar'));
    }

    public function tienda($slug)
    {
        $tienda = Negocio::where('slug' , $slug)->first();
        $carrito = Cart::content();
        $productos = $tienda->productos;
        $total = 0;
        $totalMobile = 0;

        return view('tienda' , compact('tienda' , 'carrito' , 'productos','total' , 'totalMobile'));
    }
}
