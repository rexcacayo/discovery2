<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parametro extends Model
{
  protected $table = 'parametros';
  use SoftDeletes;
  protected $fillable = ['id'];
    /**
     * parametro belongsTo pregunta
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function pregunta()
    {
        return $this->belongsTo(\App\Pregunta::class);
    }
 }