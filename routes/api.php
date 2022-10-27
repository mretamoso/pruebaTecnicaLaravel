<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('especialidad','App\Http\Controllers\EspecialidadController@getEspecialidad');//TODO toma la funcion getEspecialidad
//Route::get('curso','App\Http\Controllers\CursoController@getCurso');//TODO toma la funcion getEspecialidad

Route::get('especialidad/{id}','App\Http\Controllers\ESpecialidadController@getEspecialidadxid'); //TODO toma la funcion getEspecialidadxid
Route::get('curso/{id}','App\Http\Controllers\CursoController@getCursoxid'); //TODO toma la funcion getEspecialidadxid

Route::post('addEspecialidad','App\Http\Controllers\EspecialidadController@insertEspecialidad');//TODO toma la funcion insertEspecialidad
Route::post('addCurso','App\Http\Controllers\CursoController@insertCurso');//TODO toma la funcion insertEspecialidad

Route::put('updateEspecialidad/{id}','App\Http\Controllers\EspecialidadController@updateEspecialidad');//TODO toma la funcion updateEspecialidad
Route::put('updateCurso/{id}','App\Http\Controllers\CursoController@updateCurso');//TODO toma la funcion updateEspecialidad

Route::delete('deleteEspecialidad/{id}','App\Http\Controllers\EspecialidadController@deleteEspecialidad'); //TODO toma la funcion deleteEspecialidad
Route::delete('deleteCurso/{id}','App\Http\Controllers\CursoController@deleteCurso'); //TODO toma la funcion deleteEspecialidad


Route::get('home/{curso_id}','App\Http\Controllers\HomeController@curso'); 
