<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
  protected $table = 'clientes';
  use SoftDeletes;
  protected $fillable = ['id'];
}
