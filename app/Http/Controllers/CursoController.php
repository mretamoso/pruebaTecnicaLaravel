<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\curso;

class CursoController extends Controller
{
    public function getCurso(){
        return response()->json(curso::all(),200);//TODO devuelve un JSON de m, devuelve todo "all"
    }

    public function getCursoxid($id){
        $curso = curso::find($id); //TODO buscar por id en el model curso
        if (is_null($curso)) { //TODO si la variable declarada es null hacer
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404); //TODO devuelve Json con un mensaje
        }
        return response()->json($curso::find($id), 200); //TODO encaso devuelva data, devuelve un json de $curso buscando id
    }

    public function insertCurso(Request $request)
    {
        $curso = curso::create($request->all()); //TODO se almacena en curso cuando se cree el nuevo registro
        return response($curso, 200);
    }

    public function updateCurso(Request $request,$id){
        $curso = curso::find($id); //TODO buscar por id en el model curso
        if (is_null($curso)) { //TODO si la variable curso es null hacer
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404); //TODO devuelve Json con un mensaje
        }
        $curso->update($request->all()); //TODO en caso devuelva data curso actualiza el punto que se selecciona
        return response($curso,200);
    }

    public function deleteCurso($id){
        $curso = curso::find($id);
        if (is_null($curso)) { //TODO si la variable especialidad es null hacer
            return response()->json(['Mensaje' => 'Registro no encontrado'], 404); //TODO devuelve Json con un mensaje
        }
        $curso->delete();
            return response()->json(['Mensaje' => ' Registro eliminado'],200);
    }
}
