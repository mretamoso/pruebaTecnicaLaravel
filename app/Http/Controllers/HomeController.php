<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
// use App\Models\UsuarioAvance;
use App\Models\Especialidad;
use App\Models\Instructor;
use App\Models\Curso;

class HomeController extends Controller
{

    public function curso($especialidad_id)
    {
        // por ahora estoy colocando el token, pero el token debe generarse y ser autentificado por el login 
        $token = 'eyJhbGciOiJIUzI1Ni'; //TODO token manual
        $usuario  = Usuario::where("token", $token)->first(); //TODO primera condicion a traer
        $data = []; //TODO variable declarada para ser mostrada en un json mediante un vacio en array


        $especialidad = Especialidad::where("id", $especialidad_id)->first(["id", "nombre"]); //TODO traer primero el id y el nombre
        $instructor = Instructor::where(["especialidad_id" => $especialidad->id])->first(["id", "nombre", "foto", "sobre_mi"]); //TODO ubicar la FK y traer los campos declarados
        $curso = Curso::join("capitulos", "capitulos.curso_id", "cursos.id")//TODO se indica la FK entre capitulos y curso
            ->leftjoin("usuario_avances", "usuario_avances.capitulo_id", "capitulos.id") //TODO se indica la FK entre usuariosavances y capitulo
            ->get([ //TODO obtener lo siguiente: y asignandole nombre
                "cursos.id as curso_id",
                "cursos.nombre as curso_name",
                "notas",
                "capitulos.id as capitulos_id",
                "capitulos.nombre as capitulos_nombres", "is_done", "capitulos.url"
            ]);
        $resultado_cursos = [];//TODO iniciar variable en array vacia
        $completado = 0; //TODO acumulador de capitulos completaods
        $total_capitulos = 0; //TODO total de capitulos
        $curso_actual = 0; //TODO estado del curso 0/1
        $activado = false; //TODO curso disponible 

        foreach ($curso as $value) {
            if (!array_key_exists($value->curso_id, $resultado_cursos)) { //TODO si el valor existe dentro del array toncs 
                $resultado_cursos[$value->curso_id] = [
                    "curso_id" => $value->curso_id,
                    "curso_nombre" => $value->curso_name,
                    "nota" => $value->notas,
                    "resource" => [],
                    "discussion" => [],
                    "quiz" => [],
                    "capitulos" => [],
                ];
            }

            if ($value->is_done == 0 && $activado == false) {
                $curso_actual = 1;
                $activado = true;
            } else {
                $curso_actual = 0;
            }

            if ($value->is_done == 1 ||   $curso_actual == 1) {
                $locked = "open";
            } else {
                $locked = "closed";
            }


            $resultado_cursos[$value->cursos_id]["capitulos"][] = [
                "capitulo_id" => $value->capitulos_id,
                "capitulos_nombres" => $value->capitulos_nombres,
                "video" => $value->url,
                "is_done" => $value->is_done > 0 ? 1 : 0,
                "cursoActual" => $curso_actual,
                "locked" => $locked
            ];

            if ($value->is_done ==  1) {
                $completado++;
            }
            $total_capitulos++;
        }




        $data["Titulo"] = $especialidad->nombre;
        $data["Autor"] = $instructor->nombre;
        $data["Completado"] = $completado . "/" . $total_capitulos . " COMPLETADO";
        $data["Cursos"] = array_values($resultado_cursos);//TODO agregando el arrays de resultado cursos
        $data["Informacion de autor"] = [
            "Titulo" => "sobre el instructor",
            "Foto" => $instructor->foto, 
            "Sobre mi" => $instructor->sobre_mi, 
        ];






        return  $this->response_json(200, 'SUCCESSFUL', $data);
    }
}
