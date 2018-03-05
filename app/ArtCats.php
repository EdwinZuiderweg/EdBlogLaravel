<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtCats extends Model
{
  //Tabelnaam van database
  protected $table = 'ArtCats';

  //Primary key name van tabel
  protected $primaryKey = ['artikelnr', 'catnr'];
}
