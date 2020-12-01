<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table='products';
    protected $fillable=['barcode','name','category_id','buy','sell','stock','supplier_id'];

public function category(){
   return $this-> belongsTo(category::class);
}
public function supplier(){
   return $this-> belongsTo(supplier::class);
}
}