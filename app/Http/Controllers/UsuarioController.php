<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\User;
use App\Direccion;
use App\Negocio;
use App\Producto;
use App\Orden;
use App\Compra;

class UsuarioController extends Controller
{
    public function favoritos()
    {
    	return view('user.favoritos');
    }

    public function direcciones()
    {
    	return view('user.direcciones');
    }

    public function datos()
    {
    	return view('user.datos');
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

        return redirect()->route('usuario.pedidos')->with('status' , 'Compra registrada');

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

        $user = User::create($datos);
        $user->assignRole('negocio');

        $negociodatos['user_id'] = $user->id;
        $negociodatos['nombre'] = $request->nombre_negocio;
        $negociodatos['slug'] = str_slug($request->nombre_negocio);
        $negociodatos['descripcion'] = $request->descripcion_negocio;
        $negociodatos['direccion'] = $request->direccion;

        $negocio = Negocio::create($negociodatos);

        Auth::login($user);

        return redirect('/');
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
        $user->save();

        return redirect()->back()->with('status' , 'Datos Actualizados');
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
}
