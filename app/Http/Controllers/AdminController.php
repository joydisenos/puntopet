<?php

namespace App\Http\Controllers;

use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use Illuminate\Http\Request;
use App\User;
use App\Legal;
use App\Negocio;
use App\Clase;

class AdminController extends Controller
{
    public function configuraciones()
    {
    	$legales = Legal::all();

    	return view('admin.configuraciones' , compact('legales'));
    }

    public function usuarios()
    {
    	$usuarios = User::all();

    	return view('admin.usuarios' , compact('usuarios'));
    }

    public function seccion($pagina)
    {
        $legal = Legal::where('slug' , $pagina)->first();

        return view('admin.editarseccion' , compact('legal'));
    }

    public function actualizarSeccion(Request $request , $id)
    {
        $legal = Legal::findOrFail($id);
        $legal->texto = $request->texto;
        $legal->valor = $request->valor;
        $legal->save();

        return redirect()->route('admin.configuraciones')->with('status' , 'Sección actualizada');
    }

    public function sesiones()
    {
        $negocios = Negocio::all();

        return view('admin.sesiones' , compact('negocios'));
    }

    public function sesionesNegocio($negocio)
    {
        $negocio = Negocio::where('slug' , $negocio)->first();
        $sesiones = $negocio->visitasDetalle();

        return view('admin.sesionesnegocio' , compact('negocio' , 'sesiones'));
    }

    public function slider()
    {
        $tiendas = Negocio::all();

        return view('admin.slider' , compact('tiendas'));
    }

    public function sliderDestacar(Request $request)
    {
        $tienda = Negocio::findOrFail($request->id);

        if($tienda->destacado == 1)
        {
            $tienda->destacado = 0;
        }else{
            $tienda->destacado = 1;
        }

        $tienda->save();

        return response()->json([
                                    'estatus' => $tienda->destacado
                                ]);
    }

    public function tiposNegocio()
    {
        $tipos = Clase::all();

        return view('admin.clases' , compact('tipos'));
    }

    public function registrarTiposNegocio(Request $request)
    {
        $validatedData = $request->validate([
        'nombre' => 'required|max:255|min:3',
        ]);

        $data = $request->all();
        $data['slug'] = str_slug($request->nombre);

        $tipo = Clase::create($data);

        return redirect()->back()->with('status' , 'Clase Registrada');
    }

    public function eliminarTiposNegocio($id)
    {
        $tipo = Clase::findOrFail($id);

        $negocios = Negocio::where('clase_id' , $id)->get();

        foreach ($negocios as $key => $negocio) {
            $negocio->clase_id = null;
            $negocio->save();
        }

        $tipo->delete();

        return redirect()->back()->with('status' , 'Clase eliminada');
    }
}
