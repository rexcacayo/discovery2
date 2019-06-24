<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarjeta extends Model
{
    protected $table = 'tarjetas';
    use SoftDeletes;
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