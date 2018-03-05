<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  //Tabelnaam van database
  protected $table = 'Artikelen';
  
  //Primary key name van tabel
  protected $primaryKey = 'Artnr';
}
