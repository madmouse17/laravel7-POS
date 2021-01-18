<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class product extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['barcode','name','category_id','buy','sell','stock','supplier_id'];
    protected static $recordEvents = ['Created','Updated','Deleted'];
    public function getDescriptionForEvent(string $eventName): string

    {
        return "{$eventName} product";
    }
    protected static $logName = "Product";
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