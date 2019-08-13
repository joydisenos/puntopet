<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Producto;
use App\Negocio;
use App\Hogar;
use App\Foto;
use App\Orden;
use App\Mascota;

class NegocioController extends Controller
{
    public function productos()
    {
    	$productos = Auth::user()->productos;

    	return view('negocio.productos' , compact('productos'));
    }

    public function mascotas()
    {
        $mascotas = Auth::user()->mascotas;

        return view('negocio.mascotas' , compact('mascotas'));
    }

    public function crearProducto()
    {
    	return view('negocio.crearproducto');
    }

    public function crearMascota()
    {
        return view('negocio.crearmascota');
    }

    public function registrarNegocio(Request $request)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'direccion' => 'required',
        'descripcion' => 'required',
        ]);

        $comprobar = Negocio::where('slug' , str_slug($request->nombre))->first();
        
        if($comprobar != null)
        {
            return redirect()->back()->with('error' , 'Ya hay un registro con ese nombre, por favor intente con otro');
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = str_slug($request->nombre);

        if( $request->hasFile('foto_local') )
        {
            $rutaLocal = 'archivos/'. Auth::user()->id;
            $fotoLocal = $request->file('foto_local');
            $nombreFotoLocal = $fotoLocal->getClientOriginalName();
            $request->file('foto_local')->storeAs($rutaLocal, $nombreFotoLocal, 'public');
            $data['foto_local'] = $nombreFotoLocal;
        }

        if( $request->hasFile('logo_local') )
        {
            $rutaLogo = 'archivos/'. Auth::user()->id;
            $fotoLogo = $request->file('logo_local');
            $nombreLogoLocal = $fotoLogo->getClientOriginalName();
            $request->file('logo_local')->storeAs($rutaLogo, $nombreLogoLocal, 'public');
            $data['logo_local'] = $nombreLogoLocal;
        }

        $negocio = Negocio::create($data);

        return redirect()->back()->with('status' , 'Negocio '. title_case($negocio->nombre) . ' creado con éxito');
    }

    public function registrarHogar(Request $request)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'direccion' => 'required',
        'descripcion' => 'required',
        ]);

        $comprobar = Hogar::where('slug' , str_slug($request->nombre))->first();

        if($comprobar != null)
        {
            return redirect()->back()->with('error' , 'Ya hay un registro con ese nombre, por favor intente con otro');
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = str_slug($request->nombre);

        if( $request->hasFile('foto_local') )
        {
            $rutaLocal = 'archivos/'. Auth::user()->id;
            $fotoLocal = $request->file('foto_local');
            $nombreFotoLocal = $fotoLocal->getClientOriginalName();
            $request->file('foto_local')->storeAs($rutaLocal, $nombreFotoLocal, 'public');
            $data['foto_local'] = $nombreFoto;
        }

        if( $request->hasFile('logo_local') )
        {
            $rutaLogo = 'archivos/'. Auth::user()->id;
            $fotoLogo = $request->file('logo_local');
            $nombreLogoLocal = $fotoLogo->getClientOriginalName();
            $request->file('logo_local')->storeAs($rutaLogo, $nombreLogoLocal, 'public');
            $data['logo_local'] = $nombreLogoLocal;
        }

        $hogar = Hogar::create($data);

        return redirect()->back()->with('status' , 'Hogar '. title_case($hogar->nombre) . ' creado con éxito');
    }

    public function guardarProducto(Request $request)
    {
    	$validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'precio' => 'required',
        'descripcion' => 'required',
        ]);

        $data = $request->except(['foto']);
        $data['user_id'] = Auth::user()->id;

    	if( $request->hasFile('foto') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['foto'] = $nombreFoto;
        }

        $producto = Producto::create($data);

        return redirect()->route('negocio.productos')->with('status' , 'Producto Creado');
    }

    public function guardarMascota(Request $request)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'descripcion' => 'required',
        ]);

        $data = $request->except(['foto']);
        $data['user_id'] = Auth::user()->id;

        if( $request->hasFile('foto') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['foto'] = $nombreFoto;
        }

        $producto = Mascota::create($data);

        return redirect()->route('negocio.mascotas')->with('status' , 'Mascota Creada');
    }

    public function modificarProducto($id)
    {
    	$producto = Producto::findOrFail($id);
    	
    	if($producto->user_id != Auth::user()->id)
    	{
    		return redirect()->back();
    	}

    	return view('negocio.editarproducto' , compact('producto'));
    }

    public function modificarProductoEstatus(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        
        if($producto->estatus == 0)
        {
            $producto->estatus = 1;
        }else{
            $producto->estatus = 0;
        }
        $producto->save();

        return response()->json([
                                    'estatus' => $producto->estatus
                                ]);
    }

    public function modificarMascota($id)
    {
        $mascota = Mascota::findOrFail($id);
        
        if($mascota->user_id != Auth::user()->id)
        {
            return redirect()->back();
        }

        return view('negocio.editarmascota' , compact('mascota'));
    }

    public function actualizarProducto(Request $request , $id)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'precio' => 'required',
        'descripcion' => 'required',
        ]);

        $data = $request->except(['foto']);

        if( $request->hasFile('foto') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['foto'] = $nombreFoto;
        }

        $producto = Producto::findOrFail($id)->update($data);

        return redirect()->route('negocio.productos')->with('status' , 'Producto Actualizado');
    }

    public function estatusNegocio(Request $request)
    {
        $negocio = Negocio::findOrFail($request->id);

        $campo = $negocio[$request->campo];

        if($campo == 0)
            {
                $data[$request->campo] = 1;
            }
        else{
                $data[$request->campo] = 0;
            }

        $negocio->update($data);

        return response()->json([
                                    'campo' => $campo
                                ]);
    }

    public function actualizarMascota(Request $request , $id)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255',
        'descripcion' => 'required',
        ]);

        $data = $request->except(['foto']);

        if( $request->hasFile('foto') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['foto'] = $nombreFoto;
        }

        $producto = Mascota::findOrFail($id)->update($data);

        return redirect()->route('negocio.mascotas')->with('status' , 'Mascota Actualizada');
    }

    public function datos()
    {
        return view('negocio.datos');
    }

    public function verOrden($id)
    {
        $orden = Orden::findOrFail($id);

        if($orden->negocio->user->id != Auth::user()->id)
        {
            return redirect()->back();
        }else{

            return view('negocio.orden' , compact('orden'));
        }
        
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

    public function estatusOrden($id , $estatus)
    {
        $producto = Orden::findOrFail($id);
        $producto->estatus = $estatus;
        $producto->save();

        return redirect()->back()->with('status' , 'Estatus actualizado');
    }

    public function editarNegocio($id)
    {
        $negocio = Negocio::findOrFail($id);

        return view('negocio.editarnegocio' , compact('negocio'));
    }

    public function editarHogar($id)
    {
        $hogar = Hogar::findOrFail($id);

        return view('negocio.editarhogar' , compact('hogar'));
    }

    public function actualizarNegocio(Request $request , $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'descripcion' => 'required',
            ]);

        $data = $request->all();
        // $data['slug'] = str_slug($request->nombre);

        if( $request->hasFile('foto_local') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto_local');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto_local')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['foto_local'] = $nombreFoto;
        }

        if( $request->hasFile('logo_local') )
        {
            $rutaLogo = 'archivos/'. Auth::user()->id;
            $fotoLogo = $request->file('logo_local');
            $nombreLogoLocal = $fotoLogo->getClientOriginalName();
            $request->file('logo_local')->storeAs($rutaLogo, $nombreLogoLocal, 'public');
            $data['logo_local'] = $nombreLogoLocal;
        }

        $negocio = Negocio::findOrFail($id)->update($data);

        return redirect()->route('negocio.ventas')->with('status' , 'Datos actualizados');
    }

    public function actualizarHogar(Request $request , $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'descripcion' => 'required',
            ]);

        $data = $request->all();
        // $data['slug'] = str_slug($request->nombre);

        if( $request->hasFile('foto_local') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto_local');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto_local')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['foto_local'] = $nombreFoto;
        }

        if( $request->hasFile('logo_local') )
        {
            $rutaLogo = 'archivos/'. Auth::user()->id;
            $fotoLogo = $request->file('logo_local');
            $nombreLogoLocal = $fotoLogo->getClientOriginalName();
            $request->file('logo_local')->storeAs($rutaLogo, $nombreLogoLocal, 'public');
            $data['logo_local'] = $nombreLogoLocal;
        }

        $hogar = Hogar::findOrFail($id)->update($data);

        return redirect()->route('negocio.datos')->with('status' , 'Datos actualizados');
    }

    public function ventas()
    {
        $user = Auth::user();

        if($user->hasRole('negocio'))
        {
            $negocios = Auth::user()->negocios;
            $hogares = [];
        }else if($user->hasRole('hogar'))
        {
            $hogares = Auth::user()->hogares;
            $negocios = [];
        }

        return view('negocio.ventas' , compact('negocios' , 'hogares'));
    }

    public function ventasNegocio($slug)
    {
        $negocio = Negocio::where('slug' , $slug)->first();
        $ventas = $negocio->ventas;

        return view('negocio.ventasnegocio' , compact('ventas'));
    }

    public function envios()
    {
        $negocios = Auth::user()->negocios;

        return view('negocio.envios' , compact('negocios'));
    }

    public function subirFotos(Request $request)
    {
         $validatedData = $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png',
            'nombre' => 'required|min:4'
            ]);

         $data = $request->except('_token');

        if( $request->hasFile('foto') )
        {
            $rutaFoto = 'archivos/'. Auth::user()->id;
            $foto = $request->file('foto');
            $nombreFoto = $foto->getClientOriginalName();
            $request->file('foto')->storeAs($rutaFoto, $nombreFoto, 'public');
            $data['ruta'] = $rutaFoto;
            $data['archivo'] = $nombreFoto;
            Foto::create($data);
        }

        return redirect()->back()->with('status' , 'Foto Guardada');
    }

    public function eliminarFoto($id)
    {
        $foto = Foto::findOrFail($id);
        Storage::disk('public')->delete($foto->ruta . '/' . $foto->archivo);
        $foto->delete();

        return redirect()->back()->with('status' , 'Foto eliminada');
    }
}
