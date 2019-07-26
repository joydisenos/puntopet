<?php

namespace App\Http\Controllers;

use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use Illuminate\Http\Request;
use App\User;
use App\Legal;
use App\Negocio;

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
}
