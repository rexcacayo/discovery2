<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pregunta extends Model
{
  protected $table = 'preguntas';
  use SoftDeletes;
  protected $fillable = ['id'];
}
