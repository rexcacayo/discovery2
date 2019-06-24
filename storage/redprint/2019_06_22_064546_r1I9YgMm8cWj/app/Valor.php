<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valor extends Model
{
  protected $table = 'valors';
  use SoftDeletes;
  protected $fillable = ['id'];
}
