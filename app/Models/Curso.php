<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
   /*  public $timestamps = false; //TODO false para no guardar fecha
    protected $fillable=['id','nombre','codigo']; //TODO trae solo los campos declarados */
    // protected $table = ['especialidads']; //TODO trae la tabla declarada
    protected $table = 'cursos';
}
