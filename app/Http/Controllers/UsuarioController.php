<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\User;
use App\Hogar;
use App\Direccion;
use App\Negocio;
use App\Producto;
use App\Orden;
use App\Compra;
use App\Favorito;
use App\Comentario;
use App\Post;

class UsuarioController extends Controller
{
    public function favoritos()
    {
        $favoritosTienda = Auth::user()->favoritosTienda;
        $favoritosHogar = Auth::user()->favoritosHogar;

    	return view('user.favoritos' , compact('favoritosTienda' ,'favoritosHogar'));
    }

    public function direcciones()
    {
    	return view('user.direcciones');
    }

    public function datos()
    {
    	return view('user.datos');
    }

    public function membresia()
    {
        return view('user.membresia');
    }

    public function blog()
    {
        $posts = Auth::user()->posts;

        return view('blog.listapost' , compact('posts'));
    }

    public function crearPost()
    {
        return view('blog.nuevopost');
    }

    public function editarPost($slug)
    {
        $post = Post::where('slug' , $slug)->firstOrFail();

        if($post->user_id != Auth::user()->id)
        {
            return redirect()->back();
        }
        
        return view('blog.editarpost' , compact('post'));
    }

    public function actualizarPost($slug , Request $request)
    {
        $post = Post::where('slug' , $slug)->firstOrFail();
        
        if($post->user_id != Auth::user()->id)
        {
            return redirect()->back();
        }
        
        $datos = $request->except(['_token' , 'imagen']);

        if( $request->hasFile('imagen') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('imagen');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('imagen')->storeAs($rutaFoto, $nombreFoto, 'public');
            $datos['imagen'] = $nombreFoto;
        }


        $post->update($datos);

        return redirect()->route('usuario.blog')->with('status' , 'Post Actualizado');
    }

    public function registrarPost(Request $request)
    {
        $validatedData = $request->validate([
        'titulo' => 'required|max:255',
        'mensaje' => 'required',
        ]);

        $data = $request->except(['_token' , 'imagen']);
        $data['user_id'] = Auth::user()->id;

        $rev = Post::where('slug' , str_slug($request->titulo))->first();
         if($rev == null)
         {
            $slug = str_slug($request->titulo);
        }else{
            $i = 0;
            while ($rev != null) {
                $rev = Post::where('slug' ,  str_slug($request->titulo) . $i )->first();
                $slug = str_slug($request->titulo) . $i;
                $i++;
            }
        }

        if( $request->hasFile('imagen') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('imagen');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('imagen')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['imagen'] = $nombreFoto;
        }

        $data['slug'] = $slug;

        Post::create($data);

        return redirect()->route('usuario.blog')->with('status' , 'Post Creado');
        

    }

    public function comentarPost(Request $request , $id)
    {
        $validatedData = $request->validate([
        'titulo' => 'required|max:255',
        'mensaje' => 'required',
        ]);

        $data = $request->except('_token');
        
        $data['user_id'] = Auth::user()->id;
        $data['post_id'] = $id;

        $rev = Post::where('slug' , str_slug($request->titulo))->first();
         if($rev == null)
         {
            $slug = str_slug($request->titulo);
        }else{
            $i = 0;
            while ($rev != null) {
                $rev = Post::where('slug' ,  str_slug($request->titulo) . $i )->first();
                $slug = str_slug($request->titulo) . $i;
                $i++;
            }
        }

        $data['slug'] = $slug;

        Post::create($data);

        return redirect()->back()->with('status' , 'Comentario Enviado!');
    }

    public function membresiaPet()
    {
        $user = Auth::user();
        $user->assignRole('pet');

        return redirect()->back()->with('status' , 'Membresía aumentada!');
    }

    public function pedidos()
    {
        $pedidos = Auth::user()->compras;

    	return view('user.pedidos' , compact('pedidos'));
    }

    public function ordenar($slug)
    {
        $tienda = Negocio::where('slug' , $slug)->first();
        $productos = $tienda->productos;
        $productosId = [];
        foreach ($productos as $key => $producto) {
            $productosId[$key] = $producto->id;
        }

        $carrito = Cart::content()->whereIn('id' , $productosId);
        $total = 0;

        return view('ordenar' , compact('carrito' , 'slug' , 'tienda' , 'total'));
    }

    public function pago($slug , Request $request)
    {
        $tienda = Negocio::where('slug' , $slug)->first();
        $productos = $tienda->productos;
        $productosId = [];
        foreach ($productos as $key => $producto) {
            $productosId[$key] = $producto->id;
        }

        $carrito = Cart::content()->whereIn('id' , $productosId);

        $ordenRequest = $request->all();
        $ordenRequest['user_id'] = Auth::user()->id;
        $ordenRequest['negocio_id'] = $tienda->id;

        $total = 0;

        foreach ($carrito as $key => $producto){
            $total += $producto->price * $producto->qty;
        }

        $ordenRequest['total'] = $total;

        $orden = Orden::create($ordenRequest);


        foreach ($carrito as $key => $producto) {

            $productoRequest['user_id'] = Auth::user()->id;
            $productoRequest['orden_id'] = $orden->id;
            $productoRequest['producto_id'] = $producto->id;
            $productoRequest['cantidad'] = $producto->qty;

            if ($producto->options->count() > 0)
            {
                $productoRequest['opciones'] = [];

                foreach ($producto->options as $key => $opcion) {
                    $productoRequest['opciones'][$key] = $opcion;
                }

                $productoRequest['opciones'] = json_encode($productoRequest['opciones']);
            }

            $compra = Compra::create($productoRequest);
        }

        Cart::destroy();

        return redirect()->route('usuario.pedidos')->with('status' , 'Compra registrada');

    }

    public function eliminarCarrito($row)
    {
        Cart::remove($row);

        return redirect()->back()->with('status' , 'Producto eliminado');
    }

    public function agregarCarrito($id ,Request $request)
    {
        $producto = Producto::findOrFail($id);
        $cart = Cart::add($id, $producto->nombre, 1, $producto->precio);
        
        return redirect()->back()->with('status' , 'Producto agregado');
    }

    public function alta(Request $request)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'apellido' => 'required|max:255',
        'email' => 'required|unique:users|email|max:255',
        'telefono' => 'required|max:255',
        'nombre_negocio' => 'required|max:255',
        'direccion' => 'required|max:255',
        'ciudad' => 'required|max:255',
        'password' => 'required|min:6|confirmed|string',
        ]);
        
        $datos = $request->except(['password_confirmation' , 'password']);
        $datos['password'] = Hash::make($request->password);

        if($request->rol == 1)
        {
            $comprobar = Negocio::where('slug' , str_slug($request->nombre_negocio))->first();
        }else if($request->rol == 2)
        {
            $comprobar = Hogar::where('slug' , str_slug($request->nombre_negocio))->first();
        }

        if($comprobar != null)
        {
            return redirect()->back()->with('error' , 'Ya hay un registro con ese nombre, por favor intente con otro');
        }

        $user = User::create($datos);

        $negociodatos['user_id'] = $user->id;
        $negociodatos['nombre'] = $request->nombre_negocio;
        $negociodatos['slug'] = str_slug($request->nombre_negocio);
        $negociodatos['descripcion'] = $request->descripcion_negocio;
        $negociodatos['direccion'] = $request->direccion;

        if($request->rol == 1)
        {
            $user->assignRole('negocio');
            $negocio = Negocio::create($negociodatos);
        }else if($request->rol == 2)
        {
            $user->assignRole('hogar');
            $hogar = Hogar::create($negociodatos);
        }

        Auth::login($user);

        return redirect('/bienvenido');
    }

    public function actualizarDatos(Request $request)
    {
        if($request->password != null)
        {
            $validatedData = $request->validate([
            'password' => 'required|min:6|confirmed|string',
            ]);
        }

        if( $request->hasFile('foto_perfil') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto_perfil');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto_perfil')->storeAs($rutaFoto, $nombreFoto, 'public');
        }

        $user = Auth::user();
        if( $request->password != null )
        {
            $user->password =  Hash::make($request->password);
        }
        if ( $request->hasFile('foto_perfil') )
        {
            $user->foto_perfil = $nombreFoto;
        }
        $user->telefono = $request->telefono;
        $user->save();

        return redirect()->back()->with('status' , 'Datos Actualizados');
    }

    public function verOrden($id)
    {
        $orden = Orden::findOrFail($id);

        if($orden->user->id != Auth::user()->id)
        {
            return redirect()->back();
        }else{

            return view('user.orden' , compact('orden'));
        }
        
    }

    public function agregarDireccion(Request $request)
    {
        $validatedData = $request->validate([
            'direccion' => 'required'
            ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $direccion = Direccion::create($data);

        return redirect()->back()->with( 'status' , 'Dirección agregada');
    }

    public function sugerir(Request $request)
    {
        return redirect('/');
    }

    public function actualizarFavorito(Request $request)
    {
        if($request->tipo == 'tienda'){
                $favorito = Favorito::where('negocio_id' , $request->id)->first();
                if($favorito == null)
                {
                    Favorito::create([
                        'user_id' => Auth::user()->id,
                        'negocio_id' => $request->id
                    ]);
                    $estatus = 'guardado';
                }else{
                    $favorito->delete();
                    $estatus = 'eliminado';
                }
        }else{
                $favorito = Favorito::where('hogar_id' , $request->id)->first();
                if($favorito == null)
                {
                    Favorito::create([
                        'user_id' => Auth::user()->id,
                        'hogar_id' => $request->id
                    ]);
                    $estatus = 'guardado';
                }else{
                    $favorito->delete();
                    $estatus = 'eliminado';
                }
        }

        return response()->json(['data' => 'actualizado' , 'estatus' => $estatus]);
    }

    public function comentar(Request $request)
    {
        $validatedData = $request->validate([
        'comentario' => 'required|max:255|min:3',
        'puntos' => 'required'
        ]);

        if($request->has('orden_id'))
        {
            $orden = Orden::findOrFail($request->orden_id);
            $orden->estatus = 3;
            $orden->save();
            $data['orden_id'] = $orden->id;
            $data['negocio_id'] = $orden->negocio->id;
        }else{

            $data['negocio_id'] = $request->negocio_id;
        }

        $data['comentario'] = $request->comentario;
        $data['puntos'] = $request->puntos;
        $data['user_id'] = $request->user_id;

        $comentario = Comentario::create($data);

        return redirect()->back()->with('status' , 'Comentario publicado');
    }
}
