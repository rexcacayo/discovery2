<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acompanante extends Model
{
    protected $table = 'acompanantes';
    protected $fillable = ['id'];
    /**
     * acompanante belongsTo cliente
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function cliente()
    {
        return $this->belongsTo(\App\Cliente::class);
    }
 }