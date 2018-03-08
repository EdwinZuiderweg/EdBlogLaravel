<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
  //Tabelnaam van database
  protected $table = 'Reacties';
  protected $primaryKey = 'reactienr';
  public $timestamps = false;
}
