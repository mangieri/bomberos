<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Ingreso;
use App\TipoAsistencia;
use App\Bombero;
use App\BomberoServicio;

class IngresoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listar()
    {
        $ingresados=Ingreso::all();
        return view('asistencia/ingresados',compact('ingresados'));
    }
    public function indexPresentes($servicio,$acargo)
    {
        $ingresados=Ingreso::all();
        $bomberos=Bombero::where('activo',1)->get();
        return view('asistencia/presentes',compact('ingresados','bomberos','servicio','acargo'));
    }

    public function editPresentes($servicio)
    {
        $bomberos=BomberoServicio::where('servicio_id',$servicio)->orderBy('tipo_id')->get();
        return view('asistencia/participantes',compact('bomberos','servicio'));
    }


    public function show($servicio)
    {
        $bomberos=BomberoServicio::where('servicio_id',$servicio)->orderBy('tipo_id')->get();
        return view('asistencia/servicio',compact('bomberos','servicio'));
    }

    public function guardarIngreso(Request $request){
      Ingreso::create($request->all());
    }

    public function borrarIngreso($id_bombero){
      $bombero=Ingreso::where('id_bombero', $id_bombero);
      $bombero->delete();
    }
}
