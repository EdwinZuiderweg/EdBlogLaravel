<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  //Tabelnaam van database
  protected $table = 'categorieen';
  
  //Primary key name van tabel
  protected $primaryKey = 'catid';
}
