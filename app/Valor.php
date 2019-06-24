<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valor extends Model
{
    protected $table = 'valors';
    use SoftDeletes;
    protected $fillable = ['id'];
    /**
     * valor belongsTo pregunta
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function pregunta()
    {
        return $this->belongsTo(\App\Pregunta::class);
    }
}
