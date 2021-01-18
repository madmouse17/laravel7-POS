<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
class category extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['name'];
    protected static $recordEvents = ['Created','Updated','Deleted'];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} Category";
    }
    protected static $logName = "Category";

    protected $table='categories';
    protected $fillable=['name'];

public function product(){
   return $this-> hasMany(product::class);
}
}