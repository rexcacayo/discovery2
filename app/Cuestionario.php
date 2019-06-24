<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuestionario extends Model
{
    protected $table = 'cuestionarios';
    use SoftDeletes;
    protected $fillable = ['id'];
    /**
     * cuestionario belongsTo pregunta
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function pregunta()
    {
        return $this->belongsTo(\App\Pregunta::class);
    }
    /**
     * cuestionario belongsTo cliente
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function cliente()
    {
        return $this->belongsTo(\App\Cliente::class);
    }
}
