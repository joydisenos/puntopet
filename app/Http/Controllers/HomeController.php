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
use App\Post;

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

    public function blog()
    {
        $postRef = new Post();
        $posts = $postRef->posts();

        return view('blog.home' , compact('posts'));
    }

    public function verBlog($slug)
    {
        $post = Post::where('slug' , $slug)->firstOrFail();

        return view('blog.blog' , compact('post'));
    }

    public function buscarPost(Request $request)
    {
        $postRef = new Post();

        if($request->nombre != null){

            $postRef = $postRef->where('titulo' , 'LIKE' , "%$request->nombre%")
                                    ->orWhere('mensaje' , 'LIKE' , "%$request->nombre%");
            
        }

        $posts = $postRef->get();

        return view('blog.home' , compact('posts'));
    }

    public function buscarTienda(Request $request)
    {
        $tiendasRef = new Negocio();

        if($request->nombre != null){

            $tiendasRef = $tiendasRef->where('nombre' , 'LIKE' , "%$request->nombre%");
            
        }

        if($request->ciudad != null){

            $ciudad = Ciudad::where('slug' , $request->ciudad)->first();
            $tiendasRef = $tiendasRef->where('ciudad_id' , $ciudad->id);
        }

        if($request->comuna != null){

            $comuna = Comuna::where('slug' , $request->comuna)->first();
            $tiendasRef = $tiendasRef->where('comuna_id' , $comuna->id);
            
        }

        if($request->tipo != null){

            $tipo = Clase::where('slug' , $request->tipo)->first();
            
            $tiendasRef = $tiendasRef->where('clase_id' , $tipo->id);
        }

        $tiendas = $tiendasRef->get();

        return view('tiendas' , compact('tiendas'));
    }

    public function buscarHogar(Request $request)
    {
        $tiendasRef = new Hogar();

        if($request->nombre != null){

            $tiendasRef = $tiendasRef->where('nombre' , 'LIKE' , "%$request->nombre%");
            
        }

        if($request->ciudad != null){

            $ciudad = Ciudad::where('slug' , $request->ciudad)->first();
            $tiendasRef = $tiendasRef->where('ciudad_id' , $ciudad->id);
        }

        if($request->comuna != null){

            $comuna = Comuna::where('slug' , $request->comuna)->first();
            $tiendasRef = $tiendasRef->where('comuna_id' , $comuna->id);
            
        }

        $tiendas = $tiendasRef->get();

        return view('hogares' , compact('tiendas'));
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
        if($hogar == null)
        {
            return redirect('/');
        }
        
        return view('hogar' , compact('hogar'));
    }

    public function tienda($slug)
    {
        $tienda = Negocio::where('slug' , $slug)->first();
        if($tienda == null)
        {
            return redirect('/');
        }

        $productos = $tienda->productos;
        $productosId = [];
        foreach ($productos as $key => $producto) {
            $productosId[$key] = $producto->id;
        }
        
        $carrito = Cart::content()->whereIn('id' , $productosId);
        $total = 0;
        $totalMobile = 0;

        return view('tienda' , compact('tienda' , 'carrito' , 'productos','total' , 'totalMobile'));
    }
}
