<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    protected $table = 'tarjetas';
    protected $fillable = ['id'];
    /**
     * tarjeta belongsTo cliente
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function cliente()
    {
        return $this->belongsTo(\App\Cliente::class);
    }
 }