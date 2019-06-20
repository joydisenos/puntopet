<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Legal;
use App\Negocio;

class HomeController extends Controller
{
   
    public function index()
    {
        return view('home');
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

    public function tienda($slug)
    {
        $tienda = Negocio::where('slug' , $slug)->first();
        $carrito = Cart::content();
        $productos = $tienda->productos;
        $total = 0;

        return view('tienda' , compact('tienda' , 'carrito' , 'productos','total'));
    }
}
