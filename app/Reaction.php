<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
  //Tabelnaam van database
  protected $table = 'Reacties';

  //Primary key name van tabel
  protected $primaryKey = 'reactienr';
}
