<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Legal;
use App\Negocio;
use App\Hogar;
use App\Producto;
use App\Mascota;
use App\Ciudad;
use App\Comuna;
use App\Clase;

class HomeController extends Controller
{
   
    public function index()
    {
        $tiendasRef = new Negocio();
        $tiendas = $tiendasRef->tiendasSlider();
        $productosRef = new Producto();
        $productos = $productosRef->productosHome();
        $mascotasRef = new Mascota();
        $mascotas = $mascotasRef->mascotasHome();
        
        return view('home' , compact('tiendas' , 'productos' , 'mascotas'));
    }

    public function buscarTienda(Request $request)
    {
        if($request->has('nombre')){

            $tiendasRef = new Negocio();
            $tiendas = $tiendasRef->where('nombre' , 'LIKE' , "%$request->nombre%")->get();

            return view('tiendas' , compact('tiendas'));
        }

        if($request->has('ciudad')){

            $ciudad = Ciudad::where('slug' , $request->ciudad)->first();
            $tiendasRef = new Negocio();
            $tiendas = $tiendasRef->where('ciudad_id' , $ciudad->id)->get();
            return view('tiendas' , compact('tiendas'));
        }

        if($request->has('comuna')){

            $comuna = Comuna::where('slug' , $request->comuna)->first();
            $tiendasRef = new Negocio();
            $tiendas = $tiendasRef->where('comuna_id' , $comuna->id)->get();
            return view('tiendas' , compact('tiendas'));
        }

        if($request->has('tipo')){

            $tipo = Clase::where('slug' , $request->tipo)->first();
            $tiendasRef = new Negocio();
            $tiendas = $tiendasRef->where('clase_id' , $tipo->id)->get();
            return view('tiendas' , compact('tiendas'));
        }

        return redirect('tiendas');
    }

    public function buscarHogar(Request $request)
    {
        if($request->has('nombre')){

            $hogarRef = new Hogar();
            $tiendas = $hogarRef->where('nombre' , 'LIKE' , "%$request->nombre%")->get();

            return view('hogares' , compact('tiendas'));
        }

        if($request->has('ciudad')){

            $ciudad = Ciudad::where('slug' , $request->ciudad)->first();
            $hogarRef = new Hogar();
            $tiendas = $hogarRef->where('ciudad_id' , $ciudad->id)->get();
            return view('hogares' , compact('tiendas'));
        }

        if($request->has('comuna')){

            $comuna = Comuna::where('slug' , $request->comuna)->first();
            $hogarRef = new Hogar();
            $tiendas = $hogarRef->where('comuna_id' , $comuna->id)->get();
            return view('hogares' , compact('tiendas'));
        }

        return redirect('hogares');
    }

    public function buscarProductos(Request $request)
    {
        if($request->has('nombre')){

            $productosRef = new Producto();
            $productos = $productosRef->where('nombre' , 'LIKE' , "%$request->nombre%")
                                        ->orWhere('descripcion' , 'LIKE' , "%$request->nombre%")
                                        ->get();

            return view('productos' , compact('productos'));
        }

        return redirect('productos');
    }

    public function buscarMascotas(Request $request)
    {
        if($request->has('nombre')){

            $mascotasRef = new Mascota();
            $mascotas = $mascotasRef->where('nombre' , 'LIKE' , "%$request->nombre%")
                                        ->orWhere('descripcion' , 'LIKE' , "%$request->nombre%")
                                        ->get();

            return view('mascotas' , compact('mascotas'));
        }

        return redirect('mascotas');
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

    public function productos()
    {
        $productosRef = new Producto();
        $productos = $productosRef->productos();

        return view('productos' , compact('productos'));
    }

    public function mascotas()
    {
        $mascotasRef = new Mascota();
        $mascotas = $mascotasRef->mascotas();

        return view('mascotas' , compact('mascotas'));
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
