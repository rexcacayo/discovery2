<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuestionario extends Model
{
  protected $table = 'cuestionarios';
  use SoftDeletes;
  protected $fillable = ['id'];
}
