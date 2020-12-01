<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table='suppliers';
    protected $fillable=['name','alamat','telp'];

public function product(){
   return $this-> belongsTo(product::class);
}
}