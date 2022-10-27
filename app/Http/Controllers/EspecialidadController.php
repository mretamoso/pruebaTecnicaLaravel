<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\especialidad;

class EspecialidadController extends Controller
{
    public function getEspecialidad(){
        return response()->json(especialidad::all(),200);//TODO devuelve un JSON de m, devuelve todo "all"
    }

    public function getEspecialidadxid($id){
        $especialidad = especialidad::find($id); //TODO buscar por id en el model especialidad
        if (is_null($especialidad)) { //TODO si la variable declarada es null hacer
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404); //TODO devuelve Json con un mensaje
        }
        return response()->json($especialidad::find($id), 200); //TODO encaso devuelva data, devuelve un json de $especialidad buscando id
    }

    public function insertEspecialidad(Request $request)
    {
        $especialidad = especialidad::create($request->all()); //TODO se almacena en especialidad cuando se cree el nuevo registro
        return response($especialidad, 200);
    }

    public function updateEspecialidad(Request $request,$id){
        $especialidad = especialidad::find($id); //TODO buscar por id en el model especialidad
        if (is_null($especialidad)) { //TODO si la variable especialidad es null hacer
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404); //TODO devuelve Json con un mensaje
        }
        $especialidad->update($request->all()); //TODO en caso devuelva data categoria actualiza el punto que se selecciona
        return response($especialidad,200);
    }

    public function deleteEspecialidad($id){
        $categoria = especialidad::find($id);
        if (is_null($categoria)) { //TODO si la variable especialidad es null hacer
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404); //TODO devuelve Json con un mensaje
        }
        $categoria->delete();
            return response()->json(['Mensaje' => ' Registro eliminado'],200);
    }
}
