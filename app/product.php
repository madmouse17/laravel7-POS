<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table='products';
    protected $fillable=['barcode','name','category_id','buy','sell','stock','supplier_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['product_format'];

    /**
     * Get product_format
     *
     * @return string
     */
    public function getProductFormatAttribute()
    {
        return $this->barcode . ' - ' . $this->name;
    }

    public function category()
    {
        return $this-> belongsTo(category::class);
    }

    public function supplier()
    {
        return $this-> belongsTo(supplier::class);
    }
}
