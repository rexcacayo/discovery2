<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    protected $table = 'clientes';
    use SoftDeletes;
    protected $fillable = ['id'];
    /**
     * cliente belongsTo tarjeta
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    /**
     * cliente belongsTo tarjeta
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function tarjeta()
    {
        return $this->belongsTo(\App\Tarjeta::class);
    }
 }