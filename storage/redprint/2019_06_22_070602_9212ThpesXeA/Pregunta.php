<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pregunta extends Model
{
    protected $table = 'preguntas';
    use SoftDeletes;
    protected $fillable = ['id'];
    /**
     * pregunta belongsTo parametro
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function parametro()
    {
        return $this->belongsTo(\App\Parametro::class);
    }
 }